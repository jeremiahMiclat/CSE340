--Query 1
INSERT INTO
    clients (
        clientFirstname,
        clientLastname,
        clientEmail,
        clientPassword,
        comment
    )
VALUES
    (
        'Tony',
        'Stark',
        'tony@starkent.com',
        'Iam1ronM@n',
        'I am the real Ironman'
    );

--Query 2
UPDATE
    clients
SET
    clientLevel = 3
WHERE
    clientFirstname = 'Tony'
    AND clientLastname = 'Stark';

--Query 3
UPDATE
    inventory
SET
    invDescription = REPLACE(
        invDescription,
        'small interior',
        'spacious interior'
    )
WHERE
    invMake = 'GM'
    and invModel = 'Hummer';

--Query 4
SELECT
    inventory.invModel,
    carclassification.classificationName
FROM
    inventory
    INNER JOIN carclassification ON inventory.classificationId = carclassification.classificationId
WHERE
    carclassification.classificationId = 1;

--Query 5
DELETE FROM
    inventory
WHERE
    invMake = 'Jeep'
    and invModel = 'Wrangler';

--Query 6
UPDATE
    inventory
SET
    invImage = concat('/phpmotors', invImage),
    invThumbnail = concat('/phpmotors', invThumbnail);