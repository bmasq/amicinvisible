from jsonToDict import participants

"""
Uses the dictionary of houses/names to create the contents
of an HTML select element.

If the dictionary contains multiple houses, an optgroup is
created for each house and the options inside it are the list of names.

If it is a single-group dictionary, the optgroup is omitted
and the options are the names in the group.

This not only automates the process of creating the dropdown menu,
it also ensures that the submitted values are always correct.

"""

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