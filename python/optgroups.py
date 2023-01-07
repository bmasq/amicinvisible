from jsonToDict import participants

optgroup = "<optgroup label='{}'>"
option = "<option value='{}'>{}</option>"
out = ""
houses = participants()

for key, group in houses.items():
    out += optgroup.format(key.upper())
    for name in group:
        out += option.format(name, name.upper())
    out += "</optgroup>"

print(out)