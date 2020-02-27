## Mars Time

### Installation

- Make sure you have Docker and Composer installed
- Go to the project root directory
- Run `docker-compose build`
- Run `docker-compose up -d`
- Go to http://localhost:8081 since we are exposing port `8081`
- Run `composer install`



### API
#### 1)  Service Health Check
- GET `/time/health-check`
- Response<br>
    - Code: Ok, 200
    - Body: "I am alive!"

#### 2) Mars Timing
- GET `/time/mars/{time}`
- Request<br>
    - (time) query param: (String), "ISO 8601" Format DateTime
    - Example: ``2020-02-25T10:31:15+0000``
    - Wiki: https://en.wikipedia.org/wiki/ISO_8601
- Response<br>
    - Success<br>
        - Code: Ok, 200
        - Body:
            ```
            {
                "Earth": {
                    "Milli": <xxxxxxxxxxxxx> Milliseconds DateTime
                },
                "Mars": {
                    "MSD": <xxx.yyy> Float Number,
                    "MTC": <hh:mm:ss> Time Format
                }
             }
  - Fail<br>
      - Code: Bad Request, 400
      - Body: Error Message

#### 3) Tests
- Unit Test
    - Run `./vendor/bin/phpunit tests/Unit`
- Functional Test
    - Run `./vendor/bin/phpunit tests/Functional`
- General
    - Run `./vendor/bin/phpunit tests`
