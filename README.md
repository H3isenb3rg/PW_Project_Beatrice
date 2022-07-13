# ArcangeloDJ 2.0

Progetto per il corso di Programmazione Web e Servizi Digitali (AA. 2021/2022) di Matteo Beatrice

- [ArcangeloDJ 2.0](#arcangelodj-20)
  - [Requirements](#requirements)
  - [Setup](#setup)
  - [Descrizione](#descrizione)
    - [Funzionalità principali](#funzionalità-principali)
## Requirements
The same as for the running example

## Setup
- Download the zip of the project
- Start XAMPP (Apache + MySQL)
  - Fix the DB paremeters in the .env file
- Create in mysql an empty db named 'arcangelodj'
- Enter in the folder "project_beatrice"
  - Run `composer update`
  - Execute the migration `php artisan migrate`
  - Execute the seed `php artisan db:seed --class=DatabaseSeeder`
  - Execute `php artisan serve` and the site is live at the given link

## Descrizione
Creare versione aggiornata e dinamica del sito già esistente [arcangelodj.it](https://www.arcangelodj.it/)

### Funzionalità principali
* Diverse pagine navigabili tramite navbar
* Pagina __*Eventi*__ con visualizzazione degli eventi futuri
  * Se utente registrato (Attendee) anche possibilità di iscrizione all'evento indicando un nome per la prenotazione e il numero di partecipanti
  * Attendee può, nella sua area riservata, visualizzare e modificare/cancellare le sue prenotazioni
  * Possibilità di filtrare per Venue
* Sezione __*Team*__ con visualizzazione componenti del team
* Pagina __*Gallery*__ con immagini (e video coming soon) 
* Possibilità da parte di utenti di tipologia Team Member di aggiungere/modificare/cancellare:
  * _Eventi_ -> Contenti un nome, descrizione, data e ora, luogo(Venue) e, se limitati, il numero di posti disponibili
  * _Venue_ -> Luoghi dove si svolgeranno gli eventi contenenti: un nome, la città, indirizzo testuale e link Google Maps(non obbligatorio)
  * _Membri del Team_ -> Con nome, ruolo e immagine
  * _Gallery Items_
* Scelta della lingua di visualizzazione (Italiano/Inglese)
