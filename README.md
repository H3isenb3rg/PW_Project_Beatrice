# PW_Project_Beatrice

Progetto per il corso di Programmazione Web e Servizi Digitali (AA. 2021/2022)  

- [PW_Project_Beatrice](#pw_project_beatrice)
  - [Descrizione](#descrizione)
    - [Funzionalità principali](#funzionalità-principali)
    - [Schemi di Alto Livello](#schemi-di-alto-livello)

## Descrizione
Creare versione aggiornata e dinamica del sito già esistente [arcangelodj.it](https://www.arcangelodj.it/)

### Funzionalità principali
* Galleria di immagini e video nella home page del sito con contenuto personalizzabile da utente *__Admin__* 
* Pagina *Eventi* con elenco di tutti gli eventi futuri e la possibilità di prenotare posti se correttamente loggati
  * Utente __*Admin*__ può creare nuovi eventi o modificare quelli esistenti
  * Ogni evento è associato ad una *Venue* che comprende il nome e link alla posizione su Google Maps(se specificata)
    * Admin ha la possibilità di aggiungere nuove *Venue*
* Pagina *Team* con l'elenco di tutti i membri del Team 
  * Utente *__Admin__* può aggiungere membri o modificare quelli esistenti

### Schemi di Alto Livello
Idea iniziale struttura pagine sito
![Schema di alto livello della struttura del sito](Docs/model.jpg "Struttura del Sito")  

Schema E/R Database
![E/R Schema DB](Docs/DB.png "Schema E/R")