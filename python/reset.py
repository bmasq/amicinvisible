from jsonToDict import participants

# Initializes the pool file with all the
# participants in the json file
def fillPool(houses):
    try:
        with open("pool", "w") as pool:
            for val in houses.values():
                for name in val:
                    pool.write(name + "\n")
    except IOError:
        print("ERROR: couldn't creat or write 'pool' file")

# main
fillPool(participants())

# empties the list of people who had already participated
with open("forbidden", "w") as f: f.write("")