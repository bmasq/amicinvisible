from jsonToDict import participants

# crea un pool des de zero amb tots els participants
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

# esborra la llista de gent que ja ha participat
with open("forbidden", "w") as f: f.write("")