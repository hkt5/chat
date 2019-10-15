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
[Get Postman Collection](http://localhost/docs/collection.json)

<!-- END_INFO -->

#general


<!-- START_ea1d9ea5c8f054fcee44df9a4662ca34 -->
## /channels/creator/{id}
> Example request:

```bash
curl -X GET -G "/channels/creator/1" 
```

```javascript
const url = new URL("/channels/creator/1");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

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
    "content": {
        "channels": [
            {
                "id": 1,
                "creator_id": 1,
                "name": "my-channel",
                "users": null,
                "created_at": null,
                "updated_at": null
            }
        ]
    },
    "error_messages": {
        "error": []
    }
}
```

### HTTP Request
`GET /channels/creator/{id}`


<!-- END_ea1d9ea5c8f054fcee44df9a4662ca34 -->

<!-- START_de8730e886cfe59641f0501f08beb399 -->
## /invitations/{id}
> Example request:

```bash
curl -X GET -G "/invitations/1" 
```

```javascript
const url = new URL("/invitations/1");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

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
    "content": {
        "invitations": []
    },
    "error_messages": {
        "error": []
    }
}
```

### HTTP Request
`GET /invitations/{id}`


<!-- END_de8730e886cfe59641f0501f08beb399 -->

<!-- START_9a427da468598621f1a2a17113afc46a -->
## /messages/{id}
> Example request:

```bash
curl -X GET -G "/messages/1" 
```

```javascript
const url = new URL("/messages/1");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

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
    "content": {
        "messages": []
    },
    "error_messages": {
        "error": []
    }
}
```

### HTTP Request
`GET /messages/{id}`


<!-- END_9a427da468598621f1a2a17113afc46a -->

<!-- START_759c2fb6af86b32ce252441b01a28683 -->
## Create new channel.

[ Create new chat channel. ]

> Example request:

```bash
curl -X POST "/channels" \
    -H "Content-Type: application/json" \
    -d '{"name":"ducimus","creator_id":3}'

```

```javascript
const url = new URL("/channels");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "name": "ducimus",
    "creator_id": 3
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
    "content": {
        "channel": {
            "name": "my-channel-2",
            "creator_id": 1,
            "id": 2
        }
    },
    "error_messages": []
}
```
> Example response (400):

```json
{
    "content": [],
    "error_messages": {
        "creator_id": [
            "The creator id field is required."
        ]
    }
}
```

### HTTP Request
`POST /channels`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    name | string |  required  | Name of new channel.
    creator_id | integer |  required  | Creator id.

<!-- END_759c2fb6af86b32ce252441b01a28683 -->

<!-- START_8f863d60c113f4d7f8e451d8b5b20075 -->
## Create invitation.

[Create new invitation to channel.]

> Example request:

```bash
curl -X POST "/invitations" \
    -H "Content-Type: application/json" \
    -d '{"channel_id":20,"user_id":15}'

```

```javascript
const url = new URL("/invitations");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "channel_id": 20,
    "user_id": 15
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
    "content": {
        "invitation": {
            "channel_id": 1,
            "user_id": 1,
            "confirmed": false,
            "id": 1
        }
    },
    "error_messages": []
}
```
> Example response (400):

```json
{
    "content": [],
    "error_messages": {
        "channel_id": [
            "The selected channel id is invalid."
        ]
    }
}
```

### HTTP Request
`POST /invitations`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    channel_id | integer |  required  | The id of channel.
    user_id | integer |  required  | The id of user.

<!-- END_8f863d60c113f4d7f8e451d8b5b20075 -->

<!-- START_c128c06c497a94b3cf48af3efc7a382f -->
## Create message.

[Create new message.]

> Example request:

```bash
curl -X POST "/messages" \
    -H "Content-Type: application/json" \
    -d '{"user_id":10,"channel_id":1}'

```

```javascript
const url = new URL("/messages");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "user_id": 10,
    "channel_id": 1
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (400):

```json
{
    "content": [],
    "error_messages": {
        "channel_id": [
            "The selected channel id is invalid."
        ]
    }
}
```

### HTTP Request
`POST /messages`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    user_id | integer |  required  | Id of user.
    channel_id | integer |  required  | Id of channel.

<!-- END_c128c06c497a94b3cf48af3efc7a382f -->


