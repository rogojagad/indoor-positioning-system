<!DOCTYPE html>
<html>
    <head>
{% include 'layouts\header.volt' %}
        <title>{% block title %}{% endblock %} - My Webpage</title>
    </head>

    <body>
        <h1>My Todo List</h1>
        {% if session.has('auth') %}
            <p style="color: white">Hello, {{session.get('auth')['username']}}</p>
            <a href="{{url("logout")}}">Logout</a>
        {% else %}
            <a href="{{url("login")}}">Login</a>
        {% endif %}

        {% block content %}{% endblock %}
    </body>
</html>