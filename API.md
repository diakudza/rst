Api Documentation
***
````
GET: /api/task/{tast}
````
Статуст задачи 

    task = integer
***
``
GET: /api/task-all
``
Получить все задачи (id, status)
***
``
POST: /api/task
``

 Добавить задачу. 
 
Обязательные поля:

     string = string|min:10 ,
    
     frequency = 'integer|between:1000,4000',
    
     repetitions = 'integer|between:1,20',
***

``
POST: /api/task-stop
``
Остановить задачу

Обязательные поля:

     task = integer
***
``
POST: /api/task-start
``
Запустить задачу

Обязательные поля:

     task = integer
***
``
POST: /api/group
``
Создать группу

Обязательные поля:

     title = 'string|min:5|max:100',
     tasks = 'array'
***
``
POST: /api/group-start
``
Запустить группу

Обязательные поля:

     group_id = integer
***
``
POST: /api/group-stop
``
Остановить группу

Обязательные поля:

     group_id = integer
***
``
GET: /api/group-status/{group}
``
Статус группы

Обязательные поля:

     group_id = integer
