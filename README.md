# Scoreboard API

#### Table of Contents

- [Technology Stack](#Technology Stack)
- [Requirements](#Requirements)
- [Installation](#installation)
- [API Endpoints](#api-endpoints)
- [Testing](#testing)


## Technology Stack

- **Backend**: PHP , Laravel
- **Database**: MYSQL
- **Other Tools**: PHPUnit , Composer , Docker , docker-compose

## Requirements

- Docker compose


## Installation

1. Clone the repository: `git clone https://github.com/ahmedesa/scoreboard-api`
2. Change to the directory: `cd scoreboard-api`
3. Build the project using make: `make install`
4. Visit `localhost:8080` in your browser

## API Endpoints

### Games

These endpoints are prefixed with `games`.

### - `POST` `/api/games/start` : Start a game.

#### Request:

```json

{
    "user_first_name": "John",
    "user_last_name": "Doe",
    "user_email": "john.doe@example.com"
}

```

#### Response:

```json
{
    "status": 201,
    "message": null,
    "data": {
        "id": 1,
        "score": null
    }
}


```

### - `POST` `/api/games/end` : End a game.

#### Request:

```json
{
    "game_id": 1,
    "user_id": 1,
    "user_score": 800
}
```

#### Response:

```json
{
    "status": 200,
    "message": null,
    "data": {
        "userPosition": 1,
        "bestScore": 850
    }
}
```

### - `GET` `/api/games/top-10-games` : Get the top 10 games for today

#### Request:

```json
{
}
```

#### Response:

```json
{
    "data": [
        {
            "id": 5,
            "score": 1000,
            "user": {
                "id": 4,
                "first_name": "Santiago",
                "last_name": "Walsh"
            }
        },
        {
            "id": 9,
            "score": 956,
            "user": {
                "id": 8,
                "first_name": "Jocelyn",
                "last_name": "Beier"
            }
        },
        {
            "id": 10,
            "score": 901,
            "user": {
                "id": 9,
                "first_name": "Shemar",
                "last_name": "Carroll"
            }
        },
        {
            "id": 8,
            "score": 821,
            "user": {
                "id": 7,
                "first_name": "Tomasa",
                "last_name": "Carroll"
            }
        },
        {
            "id": 16,
            "score": 772,
            "user": {
                "id": 15,
                "first_name": "Shirley",
                "last_name": "Hirthe"
            }
        },
        {
            "id": 7,
            "score": 737,
            "user": {
                "id": 6,
                "first_name": "Ila",
                "last_name": "Dickinson"
            }
        },
        {
            "id": 19,
            "score": 666,
            "user": {
                "id": 18,
                "first_name": "Sonny",
                "last_name": "Kris"
            }
        },
        {
            "id": 11,
            "score": 647,
            "user": {
                "id": 10,
                "first_name": "Darrin",
                "last_name": "Christiansen"
            }
        },
        {
            "id": 14,
            "score": 570,
            "user": {
                "id": 13,
                "first_name": "Dale",
                "last_name": "Gottlieb"
            }
        },
        {
            "id": 20,
            "score": 543,
            "user": {
                "id": 19,
                "first_name": "Clementina",
                "last_name": "Jacobs"
            }
        }
    ]
}
```

## Testing

Run tests using make: `make test`
