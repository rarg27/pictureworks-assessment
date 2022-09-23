# Routes

**[GET] /** `Fetch a user.`

**Query Parameters:**
<pre><code><b>id</b>      User ID. Required. Must be integer.</code></pre>

**[GET] /user/{id}** `Fetch a user.`

**URL Parameters:**
<pre><code><b>id</b>      User ID. Required. Must be integer.</code></pre>

**[POST] /** `Append comments.`

**Body Parameters:**
<pre><code><b>id</b>       User ID. Required. Must be integer.
<b>comments</b> Comments to be appended. Required.
<b>password</b> User's Password. Required.
</code></pre>
