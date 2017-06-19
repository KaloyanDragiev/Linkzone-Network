/* Логване на потребител */
SELECT
    *
FROM
    users
WHERE
    users_username=""
    AND users_password=MD5("")
    AND users_active="yes"
    
/* Регистрация на нов потребител */
INSERT INTO
    users
    (
        users_type,
        users_username,
        users_password,
        users_email,
        users_active
    )
VALUES
(
    "user",
    "anastas",
    MD5("123456"),
    "adolushanov@gmail.com",
    "yes"    
)

/* Проверка за съществуващ потребител */
SELECT
    COUNT(*) AS cnt
FROM
    users
WHERE
    users_username="anastas"
    
/* Проверка за съществуващ емайл адрес */
SELECT
    COUNT(*) AS cnt
FROM
    users
WHERE
    users_email="adolushanov@gmail.com"

/* Промяна на лични данни */
UPDATE
    users
SET
    users_fname="Анастас",
    users_lname="Долушанов",
    users_address="Христо Ботев 34",
    users_phone="123 456 789",
    users_avatar="blah.jpg"
WHERE
    users_id=1

/* Забравена парола */
SELECT
    users_id
FROM
    users
WHERE
    users_email="adolushanov@gmail.com"

/* Промяна на парола от приложението */
UPDATE
    users
SET
    users_password=MD5("987654")
WHERE
    users_id=1

/* Промяна на парола от потребителя */
UPDATE
    users
SET
    users_password=MD5("123456")
WHERE
    users_id=1

/* Публикуване на нов туит */
INSERT INTO
    tweets
    (
        tweets_user,
        tweets_text,
        tweets_active
    )
VALUES
(
    1,
    "Здравей свят!",
    "yes"
)

/* Редакция на туит */
UPDATE
    tweets
SET
    tweets_text="Това е променен туит :("
WHERE
    tweets_id=1
    
/* Изтриване на туит */
DELETE FROM
    tweets
WHERE
    tweets_id=1

/* Четене на туит */
SELECT
    tweets_id AS tid,
    users_id AS uid,
    users_username AS uuname,
    tweets_text AS ttext,
    tweets_created AS tcreated
FROM
    tweets
    LEFT JOIN users ON users_id=tweets_user
WHERE
    tweets_id=2
    AND tweets_active="yes"

/* Харесване на туит */
INSERT INTO
    likes
    (
        likes_tweet,
        likes_user
    )
VALUES
(
    2,
    1
)

/* Нехаресване на туит */
DELETE FROM
    likes
WHERE
    likes_id=1

/* Добавяне на коментар */
INSERT INTO
    comments
    (
        comments_tweet,
        comments_user,
        comments_text,
        comments_active
    )
VALUES
(
    2,
    1,
    "Коментарче :)",
    "yes"
)

/* Редакция на коментар */
UPDATE
    comments
SET
    comments_text="Променен коментар"
WHERE
    comments_id=1

/* Изтриване на коментар */
DELETE FROM
    comments
WHERE
    comments_id=1
    
/* Всички коментари към даден туит */    
SELECT
    comments_id AS cid,
    users_id AS uid,
    users_username AS uuname,
    comments_text AS ctext,
    comments_created AS ccreated
FROM
    comments
    LEFT JOIN users ON users_id=comments_user
WHERE
    comments_tweet=2

/* Следване на потребител */
INSERT INTO
    follows
    (
        follows_follower,
        follows_user,
        follows_active
    )
VALUES
(
    1,
    2,
    "yes"
)

/* Раз-следване на потребител */
DELETE FROM
    follows
WHERE
    follows_id=1
    
/* Стена на потребителя */
SELECT
    tweets_id AS tid,
    tweets_text AS ttext,
    tweets_created AS tcreated,
    users_id AS uid,
    users_username AS uuname
FROM
    tweets
    LEFT JOIN follows ON follows_user=tweets_user
    LEFT JOIN users ON users_id=tweets_user
WHERE
    follows_follower=1
    AND tweets_active="yes"
    AND follows_active="yes"


