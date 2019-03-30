<!-- START_AUTHENTICATION -->
# Authentication

## Login

Login to the application

> Example request

```javascript
const url = new URL("http://localhost/LaraSpa/public/oauth/token");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

let body = {
    client_id: 2,
    client_secret: "client secret",
    grant_type: "password",
    password: "some-password",
    username: "some-username"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```
> Example response (200):

```json
{
    "type": "Bearer ",
    "access_token": "AccessToken",
    "refresh_token": "ARefreshToken",
    "expires_in": 332432423
}
```

### HTTP Request
`POST oauth/token`

<!-- END_AUTHENTICATION -->
