import sys
from jsonToDict import participants
from random import randint

# NOTA: és aquest script el que fa la conversió a
# majúscules abans de tornar el nom perquè amb PHP
# era molt complexa la gestió de la codificació UTF-8

# comprova si el jugador ja ha participat i, si és així,
# tornarà l'error al codi PHP
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

# torna un conjunt amb els noms del pool
def poolToSet():
    pool = set()
    try:
        with open("pool", "r") as file:
            for line in file:
                pool.add(line.strip('\n'))
    except FileNotFoundError:
        print("Error: 'pool' file not found")
    return pool

# torna un "capell" d'on agafar el nom:
# una llista amb els noms que té permès agafar el participant
def hatter(player):
    houses = participants()
    pool = poolToSet()
    # conjunt de noms que s'han d'excloure
    playerHouse = set()
    for val in houses.values():
        if player in val:
            playerHouse = val
    return list(pool - playerHouse)
    
# elimina el nom que hagi tocat dels disponibles per a la següent tirada
def updatePool(name):
    with open("pool", "r+") as f:
        # llista amb cada una de les línies(=noms)
        lines = f.read().splitlines()
        lines.remove(name)
        # torna al principi del fitxer per escriure
        f.seek(0)
        f.write('\n'.join(lines))
        # esborra tot el contingut després del punter
        # (fins allà on s'ha escrit)
        f.truncate()

# afegeix el darrer participiant a la llista
# per tal que no pugui tornar a fer-ho
def updateForbidden(name):
    with open("forbidden", "a") as f:
        f.write(name + '\n')


#main
player = sys.argv[1]
forbidden(player) # s'atura si ja ha participat

# "capell" d'on el participant extraurà el seu amic invisible que
# no serà ni ell mateix ni un membre de la seva unitat familiar
hat = hatter(player)

try:
    name = hat[randint(0, len(hat) - 1)]
except:
    print("ERROR: some error while extracting name")
    exit()

updatePool(name)
updateForbidden(player)

print(name.upper())