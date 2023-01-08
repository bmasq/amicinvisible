import json

def participants():
    try:
        # dictionary with "house":"name list"
        with open("participants.json", "r") as f:
            houses = json.load(f)
        # converts lists to sets
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