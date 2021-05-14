Prosta wyszukiwarka przeszukująca bazę danych SQLite z aplikacjami na Androida. Pozwala na sortowanie wyników według etykiety lub nazwy pakietu i ograniczenie liczby wyświetlanych wyników naraz.

Aplikacja została napisana w czystym PHP, zawiera także niewielką ilość JavaScript, ale działa również bez niego.

## Wymagania
- Dowolny serwer www
- PHP
- php-sqlite3

## Opis plików
```
/
├── css
│   └── style.css - Arkusz stylów
├── icons - Użyte ikony
├── js
│   ├── autocomplete.js - Autouzupełnianie
│   └── autosubmit.js - Odświeżenie bez ponownego wysyłania formularza
├── changelog.md - Lista zmian
├── database.db - Przykładowa baza danych SQLite
├── index.php - Aplikacja
├── README.md - Opis repozytorium
├── search-api.php - To samo co index.php, ale zwraca surowe dane w formacie JSON
└── search.php - Silnik wyszukiwania
```

## Baza danych

### items

```sql
create table items(name text primary key, label text)
```

| Nazwa | Typ  | Opis          |
| ----- | ---- | ------------- |
| name  | text | Nazwa pakietu |
| label | text | Etykieta      |

Bazę danych SQLite można edytować np. programem **SQLite Database Browser**. Można go zainstalować za pomocą:

```bash
$ sudo apt install sqlitebrowser
```
