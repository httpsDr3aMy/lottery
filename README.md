# Aplikacja Loteria

## Opis
Aplikacja Loteria umożliwia użytkownikom grę w lotto, w której mogą wybierać 6 liczb z zakresu od 1 do 49. Po wykonaniu losowania aplikacja informuje użytkownika o jego wygranej oraz zapisuje historię losowań w bazie danych. 

Aplikacja jest stworzona przy użyciu PHP, MySQL oraz Docker, co umożliwia łatwą instalację i uruchomienie w środowisku kontenerów.

## Wymagania
Aby uruchomić aplikację, musisz mieć zainstalowane następujące narzędzia:
- **Docker**: umożliwia uruchomienie aplikacji w kontenerach.
- **Docker Compose**: pozwala na łatwe zarządzanie wieloma kontenerami.

## Instalacja i Uruchomienie

### 1. Sklonuj repozytorium aplikacji
Aby rozpocząć, sklonuj repozytorium na swoje lokalne środowisko:

```bash
git clone https://github.com/httpsDr3aMy/lottery.git
cd lottery
```

### 2. Uruchom aplikację za pomocą Docker Compose
Aby rozpocząć, sklonuj repozytorium na swoje lokalne środowisko:

```bash
docker-compose up
```

### 3. Import bazy danych
Aby aplikacja działała poprawnie, musisz zaimportować bazę danych. W folderze db znajduje się plik lottery.sql, który zawiera strukturę oraz dane przykładowe dla bazy danych.

### 4. Logowanie
Aby zalogować się do aplikacji, użyj poniższych danych:

Użytkownik: <strong>test</strong> <br>
Hasło: <strong>test</strong> <br><br>
Po zalogowaniu użytkownik może wybrać liczby, wziąć udział w losowaniu i sprawdzić historię swoich losowań oraz saldo.

#### Technologie
<ul>
  <li><strong>PHP</strong>: główny język aplikacji.</li>
  <li><strong>MySQL</strong>: system zarządzania bazą danych.</li>
  <li><strong>Docker</strong>: używany do uruchomienia aplikacji w kontenerach.</li>
  <li><strong>Docker Compose</strong>: umożliwia zarządzanie usługami w aplikacji.</li>
  <li><strong>TailwindCSS</strong>: framework CSS do stylizacji front-endu aplikacji.</li>
  <li><strong>JavaScript</strong>: używany do logiki front-endowej i interakcji w aplikacji.</li>
</ul>


#### Struktura projektu
<ul>
  <li><strong>db/</strong> – zawiera plik <code>lottery.sql</code> do importu bazy danych.</li>
  <li><strong>includes/</strong> – zawiera pliki funkcji i usług aplikacji.</li>
  <li><strong>src/</strong> – zawiera pliki front-endowe, w tym pliki JavaScript oraz logikę aplikacji, a także stylizacje przy użyciu <strong>TailwindCSS</strong>.</li>
  <li><strong>docker-compose.yml</strong> – plik konfiguracyjny dla Docker Compose, używany do uruchamiania aplikacji w kontenerach.</li>
  <li><strong>Dockerfile</strong> – plik do budowy obrazu kontenera dla aplikacji, używany w połączeniu z Docker Compose.</li>
</ul>


![localhost_index php](https://github.com/user-attachments/assets/bee117ce-07f5-48f6-83d3-84fa9edcf3a2)


