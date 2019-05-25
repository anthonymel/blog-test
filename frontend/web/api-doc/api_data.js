define({ "api": [
  {
    "type": "post",
    "url": "/frontend/web/auth-api/auth-by-email",
    "title": "Авторизация пользователя по username.",
    "description": "<p>Авторизация пользователя по username.</p>",
    "name": "AuthByEmail",
    "group": "Auth",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "username",
            "description": "<p>Имя пользователя.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "password",
            "description": "<p>пароль пользователя.</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "username",
            "description": "<p>Имя пользователя.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "accessToken",
            "description": "<p>Токен доступа.</p>"
          }
        ]
      }
    },
    "version": "0.1.0",
    "filename": "C:/Server/data/blog-test/frontend/controllers/AuthApiController.php",
    "groupTitle": "Auth"
  },
  {
    "type": "post",
    "url": "/frontend/web/auth-api/signup",
    "title": "Регистрация пользователя.",
    "description": "<p>Регистрация пользователя.</p>",
    "name": "Signup",
    "group": "Auth",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "username",
            "description": "<p>Имя пользователя.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "email",
            "description": "<p>Email пользователя.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "password",
            "description": "<p>Пароль пользователя.</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "username",
            "description": "<p>Имя пользователя.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "accessToken",
            "description": "<p>Токен доступа.</p>"
          }
        ]
      }
    },
    "version": "0.1.0",
    "filename": "C:/Server/data/blog-test/frontend/controllers/AuthApiController.php",
    "groupTitle": "Auth"
  },
  {
    "type": "post",
    "url": "/frontend/web/post-api/create-post",
    "title": "Отправка публикации в систему.",
    "description": "<p>Отправка публикации.</p>",
    "name": "CreatePost",
    "group": "Post",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "token",
            "description": "<p>Token пользователя.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "text",
            "description": "<p>Текст публикации.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>Заголовок публикации.</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "result",
            "description": "<p>Token пользователя.</p>"
          }
        ]
      }
    },
    "version": "0.1.0",
    "filename": "C:/Server/data/blog-test/frontend/controllers/PostApiController.php",
    "groupTitle": "Post"
  },
  {
    "type": "get",
    "url": "/frontend/web/post-api/list",
    "title": "Вывод всех записей, имеющихся в системе.",
    "description": "<p>Вывод всех записей.</p>",
    "name": "List",
    "group": "Post",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "limit",
            "description": "<p>Количество возвращаемых записей.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "offset",
            "description": "<p>Отступ (сколько записей было загружено ранее).</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String[]",
            "optional": false,
            "field": "result",
            "description": "<p>Список публикаций.</p>"
          }
        ]
      }
    },
    "version": "0.1.0",
    "filename": "C:/Server/data/blog-test/frontend/controllers/PostApiController.php",
    "groupTitle": "Post"
  },
  {
    "type": "get",
    "url": "/frontend/web/post-api/my-posts",
    "title": "Вывод записей пользователя.",
    "description": "<p>Вывод записей пользователя.</p>",
    "name": "MyPosts",
    "group": "Post",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "token",
            "description": "<p>Token пользователя.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "limit",
            "description": "<p>Количество возвращаемых записей.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": true,
            "field": "offset",
            "description": "<p>Отступ (сколько записей было загружено ранее).</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String[]",
            "optional": false,
            "field": "result",
            "description": "<p>Список публикаций.</p>"
          }
        ]
      }
    },
    "version": "0.1.0",
    "filename": "C:/Server/data/blog-test/frontend/controllers/PostApiController.php",
    "groupTitle": "Post"
  }
] });
