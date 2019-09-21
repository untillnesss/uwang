SELECT * FROM tlaporans INNER JOIN tsaldos ON tlaporans.tanggal LIKE DATE_FORMAT(tsaldos.created_at, '%Y-%m-%d') WHERE
tlaporans.idUser = 1 AND tsaldos.idUser = 1
