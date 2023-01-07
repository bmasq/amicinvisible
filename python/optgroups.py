from jsonToDict import participants

optgroup = "<optgroup label='{}'>"
option = "<option value='{}'>{}</option>"
out = ""
houses = participants()

if len(houses) > 1:
    for key, group in houses.items():
        out += optgroup.format(key.upper())
        for name in group:
            out += option.format(name, name.upper())
        out += "</optgroup>"
else:
    group = next(iter(houses.values()))
    for name in group:
        out += option.format(name, name.upper())

print(out)