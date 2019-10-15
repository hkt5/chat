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


> Example response (400):

```json
{
    "content": [],
    "error_messages": {
        "error": "SQLSTATE[42S02]: Base table or view not found: 1146 Table 'messenger.channels' doesn't exist (SQL: select * from `channels` where `creator_id` = 1)"
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


> Example response (400):

```json
{
    "content": [],
    "error_messages": {
        "error": "SQLSTATE[42S02]: Base table or view not found: 1146 Table 'messenger.invitations' doesn't exist (SQL: select * from `invitations` where `user_id` = 1 and `confirmed` = 0)"
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


> Example response (400):

```json
{
    "content": [],
    "error_messages": {
        "error": "SQLSTATE[42S02]: Base table or view not found: 1146 Table 'messenger.messages' doesn't exist (SQL: select * from `messages` where `channel_id` = 1)"
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
    -d '{"name":"omnis","creator_id":5}'

```

```javascript
const url = new URL("/channels");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "name": "omnis",
    "creator_id": 5
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
    -d '{"channel_id":7,"user_id":15}'

```

```javascript
const url = new URL("/invitations");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "channel_id": 7,
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
    -d '{"user_id":4,"channel_id":8}'

```

```javascript
const url = new URL("/messages");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "user_id": 4,
    "channel_id": 8
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

<!-- START_ce903b7ab13a2d1de4efa36802bb3f26 -->
## /channels
> Example request:

```bash
curl -X PUT "/channels" 
```

```javascript
const url = new URL("/channels");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PUT /channels`


<!-- END_ce903b7ab13a2d1de4efa36802bb3f26 -->

<!-- START_31d75fba9d8e9f5591bfb23b779f1371 -->
## /invitations
> Example request:

```bash
curl -X PUT "/invitations" 
```

```javascript
const url = new URL("/invitations");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PUT /invitations`


<!-- END_31d75fba9d8e9f5591bfb23b779f1371 -->

<!-- START_bdf4d69a168f9c742e73c1a726d5236a -->
## /messages
> Example request:

```bash
curl -X PUT "/messages" 
```

```javascript
const url = new URL("/messages");

let headers = {
    "Accept": "application/json",
    "Content-Type": "application/json",
}

fetch(url, {
    method: "PUT",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```



### HTTP Request
`PUT /messages`


<!-- END_bdf4d69a168f9c742e73c1a726d5236a -->

<!-- START_440fc4cfa00fcc2e15ab4815f19c1f55 -->
## Delete channel.

[Delete channel when I am creator.]

> Example request:

```bash
curl -X DELETE "/channels" \
    -H "Content-Type: application/json" \
    -d '{"id":14,"creator_id":4}'

```

```javascript
const url = new URL("/channels");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "id": 14,
    "creator_id": 4
}

fetch(url, {
    method: "DELETE",
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
            "id": 1,
            "creator_id": 1,
            "name": "my-channel",
            "users": null,
            "created_at": null,
            "updated_at": null
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
            "The selected creator id is invalid."
        ]
    }
}
```

### HTTP Request
`DELETE /channels`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    id | integer |  required  | Id of channel.
    creator_id | integer |  required  | Id of creator.

<!-- END_440fc4cfa00fcc2e15ab4815f19c1f55 -->

<!-- START_c3953ee3f88e9847ef9f5ec6d5438ede -->
## Delete invitation.

[Delete current invitation.]

> Example request:

```bash
curl -X DELETE "/invitations" \
    -H "Content-Type: application/json" \
    -d '{"id":2}'

```

```javascript
const url = new URL("/invitations");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "id": 2
}

fetch(url, {
    method: "DELETE",
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
            "id": 1,
            "channel_id": 1,
            "user_id": 2,
            "confirmed": 0,
            "created_at": null,
            "updated_at": null
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
        "id": [
            "The selected id is invalid."
        ]
    }
}
```

### HTTP Request
`DELETE /invitations`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    id | integer |  required  | Id of invitation.

<!-- END_c3953ee3f88e9847ef9f5ec6d5438ede -->

<!-- START_1e85b5d04200b76d209a2f4df34547c6 -->
## Delete message
[Delete current message.]

> Example request:

```bash
curl -X DELETE "/messages" \
    -H "Content-Type: application/json" \
    -d '{"id":1}'

```

```javascript
const url = new URL("/messages");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "id": 1
}

fetch(url, {
    method: "DELETE",
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
        "message": {
            "id": 1,
            "message": "Hello world",
            "channel_id": 1,
            "user_id": 1,
            "created_at": null,
            "updated_at": null
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
        "id": [
            "The selected id is invalid."
        ]
    }
}
```

### HTTP Request
`DELETE /messages`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    id | integer |  required  | Id of message.

<!-- END_1e85b5d04200b76d209a2f4df34547c6 -->


