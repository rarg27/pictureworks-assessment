# Routes

**[GET] /id=?** ```Fetch a user.```

**Query Parameters:**

> - **id** User ID. Required. Must be integer.

**[GET] /user/{id}** ```Fetch a user.```

**URL Parameters:**

> - **id** User ID. Required. Must be integer.

**[POST] /** ```Append comments.```

**Body Parameters:**
> - **id** User ID. Required. Must be integer.
> - **comments** Comments to be appended. Required.
> - **password** User's Password. Required.
