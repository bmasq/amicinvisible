import json

def participants():
    try:
        #diccionari amb "casa":"llista noms"
        with open("participants.json", "r") as f:
            houses = json.load(f)
        #converteix les llistes en conjunts
        for key, lis in houses.items():
            houses[key] = set(lis)
    except FileNotFoundError:
        print("ERROR: 'participants.json' file not found")
        exit()
    except json.JSONDecodeError:
        print("ERROR: Invalid JSON in 'participants.json' file")
        exit()
    except:
        print("Some error ocurred")
    return houses