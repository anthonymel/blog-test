define({ "api": [
  {
    "type": "post",
    "url": "/frontend/web/auth-api/auth-by-email",
    "title": "Авторизация пользователя по username.",
    "description": "<p>Авторизация пользователя по username.</p>",
    "name": "AuthByEmail",
    "group": "Auth",
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "InvalidUsernameOrPassword",
            "description": "<p>Невреный логин или пароль.</p>"
          }
        ]
      }
    },
    "version": "0.1.0",
    "filename": "C:/Server/data/blog-test/frontend/controllers/AuthApiController.php",
    "groupTitle": "Auth",
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
    }
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
            "field": "email",
            "description": "<p>Email пользователя.</p>"
          },
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
    "version": "0.1.0",
    "filename": "C:/Server/data/blog-test/frontend/controllers/AuthApiController.php",
    "groupTitle": "Auth",
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
    }
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
            "field": "text",
            "description": "<p>Текст публикации.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "title",
            "description": "<p>Заголовок публикации.</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "token",
            "description": "<p>Token пользователя.</p>"
          }
        ]
      }
    },
    "version": "0.1.0",
    "filename": "C:/Server/data/blog-test/frontend/controllers/PostApiController.php",
    "groupTitle": "Post",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Object[]",
            "optional": false,
            "field": "post",
            "description": "<p>Созданная публикация.</p>"
          },
          {
            "group": "Success 200",
            "type": "Int",
            "optional": false,
            "field": "posts.id",
            "description": "<p>ID публикации.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "posts.text",
            "description": "<p>Текст публикации.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "posts.title",
            "description": "<p>Заголовок публикации.</p>"
          },
          {
            "group": "Success 200",
            "type": "Date",
            "optional": false,
            "field": "posts.date",
            "description": "<p>Дата публикации.</p>"
          }
        ]
      }
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "WrongToken",
            "description": "<p>Неверный токен</p>"
          }
        ]
      }
    }
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
    "version": "0.1.0",
    "filename": "C:/Server/data/blog-test/frontend/controllers/PostApiController.php",
    "groupTitle": "Post",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Object[]",
            "optional": false,
            "field": "posts",
            "description": "<p>Список публикаций.</p>"
          },
          {
            "group": "Success 200",
            "type": "Int",
            "optional": false,
            "field": "posts.id",
            "description": "<p>ID публикации.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "posts.text",
            "description": "<p>Текст публикации.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "posts.title",
            "description": "<p>Заголовок публикации.</p>"
          },
          {
            "group": "Success 200",
            "type": "Date",
            "optional": false,
            "field": "posts.date",
            "description": "<p>Дата публикации.</p>"
          }
        ]
      }
    }
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
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "token",
            "description": "<p>Token пользователя.</p>"
          }
        ]
      }
    },
    "version": "0.1.0",
    "filename": "C:/Server/data/blog-test/frontend/controllers/PostApiController.php",
    "groupTitle": "Post",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "Object[]",
            "optional": false,
            "field": "posts",
            "description": "<p>Список публикаций.</p>"
          },
          {
            "group": "Success 200",
            "type": "Int",
            "optional": false,
            "field": "posts.id",
            "description": "<p>ID публикации.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "posts.text",
            "description": "<p>Текст публикации.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "posts.title",
            "description": "<p>Заголовок публикации.</p>"
          },
          {
            "group": "Success 200",
            "type": "Date",
            "optional": false,
            "field": "posts.date",
            "description": "<p>Дата публикации.</p>"
          }
        ]
      }
    },
    "error": {
      "fields": {
        "Error 4xx": [
          {
            "group": "Error 4xx",
            "optional": false,
            "field": "WrongToken",
            "description": "<p>Неверный токен</p>"
          }
        ]
      }
    }
  }
] });
