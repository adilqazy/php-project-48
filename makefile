lint:
	composer exec phpcs 2>&1 | grep -E "^(Registering|Creating|Processing|Changing|\.|E|W|\s*[0-9]+\s*\|\s*ERROR|\s*[0-9]+\s*\|\s*WARNING|Time:|Memory:|File:|Line:|Found:|DONE)"
validate:
	composer validate