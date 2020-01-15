<?php
    include "database.php";

  try
  {
      $sql = "CREATE TABLE IF NOT EXISTS `images`
      (
            `id` int(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
            `username` VARCHAR(100) NOT NULL,
            `image` VARCHAR(100) NOT NULL,
            `like_count` int(11) NOT NULL
      )";
      $conn->exec($sql);

      $sql = "CREATE TABLE IF NOT EXISTS `users`
      (
        `UsersId` INT(11) AUTO_INCREMENT PRIMARY KEY NOT NULL,
        `username` VARCHAR(255) NOT NULL,
        `usersEmail` VARCHAR(255) NOT NULL,
        `usersFirstName` VARCHAR(255) NOT NULL,
        `usersLastName` VARCHAR(255) NOT NULL,
        `usersPassword` VARCHAR(255) NOT NULL,
        `token` VARCHAR(255) NOT NULL,
        `verified`  BOOLEAN DEFAULT 0 NOT NULL
      )";
      $conn->exec($sql);

      $sql = "CREATE TABLE IF NOT EXISTS `ProfileUpdate`
      (
        `UpdateId` INT(11) AUTO_INCREMENT PRIMARY KEY NOT NULL,
        `update_userId` INT NOT NULL,
        `AboutMe` VARCHAR(255) NOT NULL,
        `Gender` VARCHAR(255) NOT NULL,
        `sexualPreference` VARCHAR(255) NOT NULL,
        `username` VARCHAR(255) NOT NULL,
        `Location` VARCHAR(255) NOT NULL,
        `Age` VARCHAR(255) NOT NULL,
        FOREIGN KEY (update_userId) REFERENCES users(UsersId)
      )";
      $conn->exec($sql);

      $sql = "CREATE TABLE IF NOT EXISTS `Comments`
      (
          `commentId` INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
          `username`   VARCHAR(128) NOT NULL,
          `imageId`    VARCHAR(255) NOT NULL,
          `date`        datetime NOT NULL,
          `comment`    TEXT NOT NULL,
          `likes_count` INT(11) NOT NULL
      )";
      $conn->exec($sql);

      $sql = "CREATE TABLE IF NOT EXISTS `PwdReset`
      (
          `pwdResetId` INT(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
          `pwdResetEmail`  TEXT NOT NULL,
          `pwdResetSelector` TEXT NOT NULL,
          `pwdResetToken` LONGTEXT NOT NULL,
          `pwdResetExpire` TEXT NOT NULL
      )";
      $conn->exec($sql);

      $sql = "CREATE TABLE IF NOT EXISTS `gallery`
      (
          `idGallery` INT(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
          `titleGallery`  LONGTEXT NOT NULL,
          `descGallery` LONGTEXT NOT NULL,
          `imgfullNameGallery` LONGTEXT NOT NULL,
          `orderGallery` TEXT NOT NULL
      )";
      $conn->exec($sql);

        $sql = "CREATE TABLE IF NOT EXISTS `Interests` 
        (
           
            InterestId INT(11) AUTO_INCREMENT PRIMARY KEY NOT NULL,
            `interest_userId` INT NOT NULL,
            InterestDescription VARCHAR(500) NOT NULL,
            username VARCHAR(255) NOT NULL,
            FOREIGN KEY (interest_userId) REFERENCES users(UsersId)
        )";
        $conn->exec($sql);
        
        
        $sql = "CREATE TABLE IF NOT EXISTS `UserInterests` 
        (
            UserId INTEGER REFERENCES Users (UserId),
            InterestId INTEGER REFERENCES Interests (InterestId),
            PRIMARY KEY (UserId, InterestId)
        )";
        $conn->exec($sql);

      $sql = "CREATE TABLE IF NOT EXISTS `webcamimage`
      (
          `idCamImage` INT(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
          `update_userId` INT NOT NULL,
          `imgfullNameCam` LONGTEXT NOT NULL,
          `username` TEXT NOT NULL,
          `userEmail` VARCHAR(255) NOT NULL,
          `likes_count` INT(11) NOT NULL,
          `orderCamImage` TEXT NOT NULL,
          FOREIGN KEY (update_userId) REFERENCES users(UsersId)
      )";
      $conn->exec($sql);

      $sql = "CREATE TABLE IF NOT EXISTS `ProfileImage`
      (
          `idCamImage` INT(11) PRIMARY KEY AUTO_INCREMENT NOT NULL,
          `update_userId` INT NOT NULL,
          `imgfullNameCam` LONGTEXT NOT NULL,
          `username` TEXT NOT NULL,
          `userEmail` VARCHAR(255) NOT NULL,
          `likes_count` INT(11) NOT NULL,
          `orderCamImage` TEXT NOT NULL,
          FOREIGN KEY (update_userId) REFERENCES users(UsersId)
      )";
      $conn->exec($sql);

      $sql = "CREATE TABLE IF NOT EXISTS `posts`
      (
          `id` INT(11),
          `text` text,
          `likes` INT(11)
      )";
      $conn->exec($sql);

      $sql = "CREATE TABLE IF NOT EXISTS `likes`
      (
          `id` INT(11),
          `userid` INT(11),
          `postid` INT(11)
      )";
      $conn->exec($sql);
  }
  catch(PDOException $e)
  {
    echo $sql . "<br>" . $e->getMessage();
  }
  $conn = null;
