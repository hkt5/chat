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


<!-- START_a5e4e3b5b5809cb34444d5d13930496d -->
## Find channels.

[Find all channels of user.]

> Example request:

```bash
curl -X GET -G "/channels/1?id=et" 
```

```javascript
const url = new URL("/channels/1");

    let params = {
            "id": "et",
        };
    Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

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
        "channels": []
    },
    "error_messages": {
        "error": []
    }
}
```
> Example response (400):

```json
{
    "content": [],
    "error_messages": {
        "error": "SQLSTATE[42S02]: Base table or view not found: 1146 Table 'messenger.invitations' doesn't exist (SQL: select * from `invitations` where `user_id` = 1 and `confirmed` = 1)"
    }
}
```

### HTTP Request
`GET /channels/{id}`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    id |  optional  | intenger required Id of user.

<!-- END_a5e4e3b5b5809cb34444d5d13930496d -->

<!-- START_ea1d9ea5c8f054fcee44df9a4662ca34 -->
## Find channels when user is creator.

[Find channels when user is creator.]

> Example request:

```bash
curl -X GET -G "/channels/creator/1?id=autem" 
```

```javascript
const url = new URL("/channels/creator/1");

    let params = {
            "id": "autem",
        };
    Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

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
        "channels": []
    },
    "error_messages": {
        "error": []
    }
}
```

### HTTP Request
`GET /channels/creator/{id}`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    id |  optional  | integer required Id of user.

<!-- END_ea1d9ea5c8f054fcee44df9a4662ca34 -->

<!-- START_de8730e886cfe59641f0501f08beb399 -->
## Find invitations.

[Find invitations for user.]

> Example request:

```bash
curl -X GET -G "/invitations/1?id=accusamus" 
```

```javascript
const url = new URL("/invitations/1");

    let params = {
            "id": "accusamus",
        };
    Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

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

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    id |  optional  | integer required Id of user.

<!-- END_de8730e886cfe59641f0501f08beb399 -->

<!-- START_9a427da468598621f1a2a17113afc46a -->
## Find messages.

[Find messages for channel.]

> Example request:

```bash
curl -X GET -G "/messages/1?id=nam" 
```

```javascript
const url = new URL("/messages/1");

    let params = {
            "id": "nam",
        };
    Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

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

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    id |  optional  | integer required Id of channel.

<!-- END_9a427da468598621f1a2a17113afc46a -->

<!-- START_0333a6c15bb93253a713f4898c8fafbe -->
## Find moderators.

[Find moderators by channel.]

> Example request:

```bash
curl -X GET -G "/moderators/1?id=quaerat" 
```

```javascript
const url = new URL("/moderators/1");

    let params = {
            "id": "quaerat",
        };
    Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

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
        "moderators": []
    },
    "error_messages": []
}
```
> Example response (400):

```json
{
    "content": [],
    "error_messages": {
        "error": "SQLSTATE[42S02]: Base table or view not found: 1146 Table 'messenger.moderators' doesn't exist (SQL: select * from `moderators` where `channel_id` = 1)"
    }
}
```

### HTTP Request
`GET /moderators/{id}`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    id |  optional  | integer required Id of channel.

<!-- END_0333a6c15bb93253a713f4898c8fafbe -->

<!-- START_2a9152104e15a17754b6a25cca306a57 -->
## Find channels.

[Find channels by moderator.]

> Example request:

```bash
curl -X GET -G "/moderators/user/1?id=occaecati" 
```

```javascript
const url = new URL("/moderators/user/1");

    let params = {
            "id": "occaecati",
        };
    Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

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
        "channels": []
    },
    "error_messages": []
}
```
> Example response (400):

```json
{
    "content": [],
    "error_messages": {
        "error": "SQLSTATE[42S02]: Base table or view not found: 1146 Table 'messenger.moderators' doesn't exist (SQL: select * from `moderators` where `user_id` = 1)"
    }
}
```

### HTTP Request
`GET /moderators/user/{id}`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    id |  optional  | integer required Id of moderator.

<!-- END_2a9152104e15a17754b6a25cca306a57 -->

<!-- START_759c2fb6af86b32ce252441b01a28683 -->
## Create new channel.

[ Create new chat channel. ]

> Example request:

```bash
curl -X POST "/channels" \
    -H "Content-Type: application/json" \
    -d '{"name":"iste","creator_id":20}'

```

```javascript
const url = new URL("/channels");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "name": "iste",
    "creator_id": 20
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
        "name": [
            "The name must be a string."
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
    -d '{"channel_id":8,"user_id":16}'

```

```javascript
const url = new URL("/invitations");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "channel_id": 8,
    "user_id": 16
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
        "user_id": [
            "The user id must be an integer."
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
    -d '{"user_id":13,"channel_id":16}'

```

```javascript
const url = new URL("/messages");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "user_id": 13,
    "channel_id": 16
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
        "message": {
            "message": "Hello world.",
            "channel_id": 1,
            "user_id": 1,
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
        "message": [
            "The message must be a string."
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

<!-- START_f85bfd86fe9f9f18a1e8aaf73843ce05 -->
## Create moderator.

[Create moderator of channel.]

> Example request:

```bash
curl -X POST "/moderators" \
    -H "Content-Type: application/json" \
    -d '{"channel_id":7,"user_id":9}'

```

```javascript
const url = new URL("/moderators");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "channel_id": 7,
    "user_id": 9
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
        "moderator": {
            "channel_id": 1,
            "user_id": 1,
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
        "user_id": [
            "The user id must be an integer."
        ]
    }
}
```

### HTTP Request
`POST /moderators`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    channel_id | integer |  required  | Id of channel.
    user_id | integer |  required  | Id of user.

<!-- END_f85bfd86fe9f9f18a1e8aaf73843ce05 -->

<!-- START_ce903b7ab13a2d1de4efa36802bb3f26 -->
## Update channel.

[Update current channel.]

> Example request:

```bash
curl -X PUT "/channels" \
    -H "Content-Type: application/json" \
    -d '{"id":2,"name":"labore","creator_id":1}'

```

```javascript
const url = new URL("/channels");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "id": 2,
    "name": "labore",
    "creator_id": 1
}

fetch(url, {
    method: "PUT",
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
            "name": "third_channel",
            "users": null,
            "created_at": null,
            "updated_at": "2019-10-15 10:33:28"
        },
        "error_messages": null
    },
    "0": 200
}
```
> Example response (400):

```json
{
    "content": [],
    "error_messages": {
        "creator_id": [
            "The creator id must be an integer."
        ]
    }
}
```

### HTTP Request
`PUT /channels`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    id | integer |  required  | Id of channel.
    name | string |  required  | Name of channel.
    creator_id | integer |  required  | Id of creator.

<!-- END_ce903b7ab13a2d1de4efa36802bb3f26 -->

<!-- START_31d75fba9d8e9f5591bfb23b779f1371 -->
## Update invitation.

[Update current invitation.]

> Example request:

```bash
curl -X PUT "/invitations" \
    -H "Content-Type: application/json" \
    -d '{"id":7,"channel_id":6,"user_id":14}'

```

```javascript
const url = new URL("/invitations");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "id": 7,
    "channel_id": 6,
    "user_id": 14
}

fetch(url, {
    method: "PUT",
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
            "confirmed": true,
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
        "confirmed": [
            "The confirmed field must be true or false."
        ]
    }
}
```

### HTTP Request
`PUT /invitations`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    id | integer |  required  | Id of invitation.
    channel_id | integer |  required  | Id of channel.
    user_id | integer |  required  | Id of user.

<!-- END_31d75fba9d8e9f5591bfb23b779f1371 -->

<!-- START_bdf4d69a168f9c742e73c1a726d5236a -->
## Update message
[Update current message]

> Example request:

```bash
curl -X PUT "/messages" \
    -H "Content-Type: application/json" \
    -d '{"id":1,"user_id":7,"channel_id":14,"message":"et"}'

```

```javascript
const url = new URL("/messages");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "id": 1,
    "user_id": 7,
    "channel_id": 14,
    "message": "et"
}

fetch(url, {
    method: "PUT",
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
            "message": "Hello World",
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
        "message": [
            "The message must be a string."
        ]
    }
}
```

### HTTP Request
`PUT /messages`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    id | integer |  required  | Id of message.
    user_id | integer |  required  | Id of user.
    channel_id | integer |  required  | Id of channel.
    message | string |  required  | Message.

<!-- END_bdf4d69a168f9c742e73c1a726d5236a -->

<!-- START_4e145a3c0998bb9bddb901babfb42f76 -->
## Update moderator
[Update current moderator.]

> Example request:

```bash
curl -X PUT "/moderators" \
    -H "Content-Type: application/json" \
    -d '{"id":19,"channel_id":18,"user_id":3}'

```

```javascript
const url = new URL("/moderators");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "id": 19,
    "channel_id": 18,
    "user_id": 3
}

fetch(url, {
    method: "PUT",
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
        "moderator": {
            "id": 1,
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
        "channel_id": [
            "The selected channel id is invalid."
        ]
    }
}
```

### HTTP Request
`PUT /moderators`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    id | integer |  required  | Id of moderator.
    channel_id | integer |  required  | Id of channel.
    user_id | integer |  required  | Id of user.

<!-- END_4e145a3c0998bb9bddb901babfb42f76 -->

<!-- START_440fc4cfa00fcc2e15ab4815f19c1f55 -->
## Delete channel.

[Delete channel when I am creator.]

> Example request:

```bash
curl -X DELETE "/channels" \
    -H "Content-Type: application/json" \
    -d '{"id":17,"creator_id":4}'

```

```javascript
const url = new URL("/channels");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "id": 17,
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
        "id": [
            "The id must be an integer."
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
    -d '{"id":18}'

```

```javascript
const url = new URL("/invitations");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "id": 18
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
            "The id must be an integer."
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
    -d '{"id":12}'

```

```javascript
const url = new URL("/messages");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "id": 12
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

<!-- START_dffaebd75c69956640c5de349e412632 -->
## Delete moderator.

[Delete current moderator.]

> Example request:

```bash
curl -X DELETE "/moderators" \
    -H "Content-Type: application/json" \
    -d '{"id":17}'

```

```javascript
const url = new URL("/moderators");

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
}

let body = {
    "id": 17
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
        "moderator": {
            "id": 1,
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
`DELETE /moderators`

#### Body Parameters

Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    id | integer |  required  | Id of moderator.

<!-- END_dffaebd75c69956640c5de349e412632 -->


