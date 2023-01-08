import sys
from jsonToDict import participants
from random import randint

""" 
The main script that takes the current participant and selects
their friend from a "hat" full of names of the other still-not-chosen
participants.

The 'hat' will not contain the player in question, nor the
people from their group (aka house).

NOTE: this script capitalizes the output before returning it
to the PHP code because handling UTF-8 encoding with PHP
was much more complex.

 """

# checks whether the player has already participated,
# in which case returns an error to the PHP code
def forbidden(name):
    try:
        with open("forbidden", "r") as f:
            fnames = f.read()
            if name in fnames:
                print(name.upper())
                exit(1)
    except FileNotFoundError:
        print("ERROR: 'forbidden' file not found")
        exit()

# returns a set with the names in the pool
def poolToSet():
    pool = set()
    try:
        with open("pool", "r") as file:
            for line in file:
                pool.add(line.strip('\n'))
    except FileNotFoundError:
        print("Error: 'pool' file not found")
    return pool

# returns a "hat" from which to take the name:
# aka a list with the names the participant is allowed to take
def hatter(player):
    houses = participants()
    pool = poolToSet()
    if len(houses) > 1:
        # sef of names to exclude
        playerHouse = set()
        for val in houses.values():
            if player in val:
                playerHouse = val
        return list(pool - playerHouse)
    # only removes the player if its a single group
    else:
        return list(pool - {player})
    
# removes the extracted name form the list of available
# people for the following extraction
def updatePool(name):
    with open("pool", "r+") as f:
        # list with every line (aka names)
        lines = f.read().splitlines()
        lines.remove(name)
        # returns to the start of the file to write
        f.seek(0)
        f.write('\n'.join(lines))
        # deletes all content after the pointer
        # (aka up to where it has written)
        f.truncate()

# adds the last participant in the list
# so they cannot participate again
def updateForbidden(name):
    with open("forbidden", "a") as f:
        f.write(name + '\n')


#main
player = sys.argv[1]
forbidden(player) # s'atura si ja ha participat

# "hat" from which the participant is extracting their friend,
# who will not be themself nor a member of their house
hat = hatter(player)

try:
    name = hat[randint(0, len(hat) - 1)]
except:
    print("ERROR: some error while extracting name")

updatePool(name)
updateForbidden(player)

print(name.upper())