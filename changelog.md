# Lista zmian

- W polu wyszukiwania działa teraz proste autouzupełnianie
- Zmieniono wyświetlane nazwy kryteriów sortowania
- Poprawiono wyświetlany tytuł
- Dodano przycisk "scroll top"
- Dodano ikony do przycisków

- search-api nie ma limitu na minimalną liczbę wyników
- jeżeli zapytanie jest puste, wyszukiwarka zwróci pustą tablicę zamiast zwracać wszystkie elementy
	- aplikacja nie będzie wysyłać pustego zapytania do wyszukiwarki
	- aplikacja nie będzie sprawdzać ilości stron jeżeli nie będzie żadnych wyników wyszukiwania
- przeniesiono css i JavaScript do oddzielnych plików