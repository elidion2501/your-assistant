---
title: API Reference

language_tabs:
- bash
- javascript

includes:

search: true

toc_footers:
- <a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---
<!-- START_INFO -->
# Info

Welcome to the generated API reference.
[Get Postman Collection](http://127.0.0.1:8000/docs/collection.json)

<!-- END_INFO -->

#Time Track


APIs for managing Time Tracks
<!-- START_f94d96b97e2962bfbbfdb7703698ffd1 -->
## GET Time Tracks

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
APi for get list with pagination of Time Tracks that user created

> Example request:

```bash
curl -X GET \
    -G "http://127.0.0.1:8000/api/TimeTrack" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}" \
    -d '{"perPage":1,"orderBy":"time_from","ordering":"ASC"}'

```

```javascript
const url = new URL(
    "http://127.0.0.1:8000/api/TimeTrack"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

let body = {
    "perPage": 1,
    "orderBy": "time_from",
    "ordering": "ASC"
}

fetch(url, {
    method: "GET",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (401):

```json
{
    "code": "401",
    "errors": {
        "message": "Unauthenticated."
    }
}
```
> Example response (200):

```json
{
    "code": "401",
    "errors": {
        "message": "Unauthenticated."
    }
}
```

### HTTP Request
`GET api/TimeTrack`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `perPage` | number |  optional  | Items per page.
        `orderBy` | string |  optional  | By which field must be ordering.
        `ordering` | string |  optional  | ASC or DESC ordering.
    
<!-- END_f94d96b97e2962bfbbfdb7703698ffd1 -->

<!-- START_665e76c392d4fddac3fb5d7aaa8c09cf -->
## Store a newly created resource in storage.

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X POST \
    "http://127.0.0.1:8000/api/TimeTrack" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://127.0.0.1:8000/api/TimeTrack"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/TimeTrack`


<!-- END_665e76c392d4fddac3fb5d7aaa8c09cf -->

<!-- START_2fb3778d6f218a026cc739d016b0d8a8 -->
## Display the specified resource.

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X GET \
    -G "http://127.0.0.1:8000/api/TimeTrack/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://127.0.0.1:8000/api/TimeTrack/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "code": "401",
    "errors": {
        "message": "Unauthenticated."
    }
}
```

### HTTP Request
`GET api/TimeTrack/{TimeTrack}`


<!-- END_2fb3778d6f218a026cc739d016b0d8a8 -->

<!-- START_56dca24ed2ba3bc45123fdbe26ec6815 -->
## Update the specified resource in storage.

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X PUT \
    "http://127.0.0.1:8000/api/TimeTrack/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://127.0.0.1:8000/api/TimeTrack/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PUT api/TimeTrack/{TimeTrack}`

`PATCH api/TimeTrack/{TimeTrack}`


<!-- END_56dca24ed2ba3bc45123fdbe26ec6815 -->

<!-- START_3e9a004ad9577f3bbcd54bd0f3aa92f1 -->
## Remove the specified resource from storage.

<br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>
> Example request:

```bash
curl -X DELETE \
    "http://127.0.0.1:8000/api/TimeTrack/1" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://127.0.0.1:8000/api/TimeTrack/1"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "DELETE",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`DELETE api/TimeTrack/{TimeTrack}`


<!-- END_3e9a004ad9577f3bbcd54bd0f3aa92f1 -->

#general


<!-- START_517c3c477184b6c16b7d080c050569d7 -->
## handle user registration request

> Example request:

```bash
curl -X POST \
    "http://127.0.0.1:8000/api/auth/signUp" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://127.0.0.1:8000/api/auth/signUp"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/auth/signUp`


<!-- END_517c3c477184b6c16b7d080c050569d7 -->

<!-- START_a925a8d22b3615f12fca79456d286859 -->
## login user to our application

> Example request:

```bash
curl -X POST \
    "http://127.0.0.1:8000/api/auth/login" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://127.0.0.1:8000/api/auth/login"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "POST",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`POST api/auth/login`


<!-- END_a925a8d22b3615f12fca79456d286859 -->

<!-- START_ff6d656b6d81a61adda963b8702034d2 -->
## This method returns authenticated user details

> Example request:

```bash
curl -X GET \
    -G "http://127.0.0.1:8000/api/auth/user" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://127.0.0.1:8000/api/auth/user"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "code": "401",
    "errors": {
        "message": "Unauthenticated."
    }
}
```

### HTTP Request
`GET api/auth/user`


<!-- END_ff6d656b6d81a61adda963b8702034d2 -->

<!-- START_c1352e2c05aad240ad4f2a9837b8422f -->
## Display a listing of the resource.

> Example request:

```bash
curl -X GET \
    -G "http://127.0.0.1:8000/api/TimeTrackType" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -H "Authorization: Bearer {token}"
```

```javascript
const url = new URL(
    "http://127.0.0.1:8000/api/TimeTrackType"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
    "Authorization": "Bearer {token}",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "code": "401",
    "errors": {
        "message": "Unauthenticated."
    }
}
```

### HTTP Request
`GET api/TimeTrackType`


<!-- END_c1352e2c05aad240ad4f2a9837b8422f -->


