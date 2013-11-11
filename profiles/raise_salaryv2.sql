DROP TRIGGER IF EXISTS raise_salery;
CREATE TRIGGER raise_salery BEFORE UPDATE ON `tache critique`
FOR EACH ROW 
	
	DECLARE done INT DEFAULT FALSE;
	DECLARE c1 CURSOR FOR SELECT `ID` FROM `tache critique` WHERE `ProjetID` = NEW.`ProjetID`;
	DECLARE c2 CURSOR FOR SELECT `ID` FROM `tache critique`;
	DECLARE c3 CURSOR FOR SELECT `Membre equipeID` FROM `membre equipe` , `compte de récompence` WHERE  `ProjetID` = NEW.`ProjetID` AND `membre equipe`.`ID` = `compte de récompence`.`Membre equipeID` ORDER BY `Points` DESC;
	DECLARE ID_c1, ID_2, ID_c3 INT;
	DECLARE nb_c1, nb_c2, nb_c3 INT;
	DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;
	begin
		SET nb_c1 = 0;
		SET nb_c2 = 0;
		SET nb_c3 = 0;
		open c2;
			read_loop2: LOOP
				FETCH c2 INTO ID_c2;
				IF done THEN
					LEAVE read_loop2;
				END IF;
				SET nb_c2 = nb_c2 + 1;
			END LOOP;			
		close c2;
		open c1;
			loop
			read_loop1: LOOP
				FETCH c1 INTO ID_c1;
				IF done THEN
					LEAVE read_loop1;
				END IF;
				SET nb_c1 = nb_c1 + 1;
			END LOOP;
			end loop;
		close c1;
		IF (nb_c1 = nb_c2) THEN
			open c3;
				read_loop3: LOOP
					FETCH c3 INTO ID_c3;
					IF done THEN
						LEAVE read_loop3;
					END IF;
					SET nb_c3 = nb_c3 + 1;
					IF nb_c3 < 3 THEN
						UPDATE  `compte de récompence` SET  salaire = salaire*1.1 WHERE `Membre equipeID` = ID_c3;
					ELSE
						UPDATE  `compte de récompence` SET  salaire = salaire*1.05 WHERE `Membre equipeID` = ID_c3;
					END IF;					
				END LOOP;				
			close c3;
		END IF;	
	end;
END;$$
----------------------------------------------------------------------------------------------------------------------------------------------------------
DROP TRIGGER IF EXISTS raise_points_tache_critique;
CREATE TRIGGER raise_points_tache_critique BEFORE UPDATE ON `tache critique`
FOR EACH ROW 
BEGIN 
	IF (NEW.`Date_fin` <> OLD.`Date_fin`) THEN	  
		IF (NEW.`Date_fin` <= NEW.`Date_critique`) THEN
			UPDATE  `compte de récompence` SET  Points = Points+1 WHERE `Membre equipeID` = NEW.`Membre equipeID`;
		END IF;
		IF (NEW.`Date_fin` > NEW.`Date_critique`) THEN
			UPDATE  `compte de récompence` SET  Points = Points-3 WHERE `Membre equipeID` = NEW.`Membre equipeID`;
		END IF;
		
	END IF;
END;$$
----------------------------------------------------------------------------------------------------------------------------------------------------------
DROP TRIGGER IF EXISTS raise_points_tache_nn_critique;
CREATE TRIGGER raise_points_tache_nn_critique BEFORE UPDATE ON `tache critique`
FOR EACH ROW 
BEGIN 
	IF (NEW.`Date_fin` <> OLD.`Date_fin`) THEN	  
		IF (NEW.`Date_fin` <= NEW.`Date_plustot`) THEN
			UPDATE  `compte de récompence` SET  Points = Points+1 WHERE `Membre equipeID` = NEW.`Membre equipeID`;
		END IF;
		IF ((NEW.`Date_fin` > NEW.`Date_plustot`) AND (NEW.`Date_fin` <= NEW.`Date_plustard`)) THEN
			UPDATE  `compte de récompence` SET  Points = Points-3 WHERE `Membre equipeID` = NEW.`Membre equipeID`;
		END IF;
		IF (NEW.`Date_fin` > NEW.`Date_plustard`) THEN
			UPDATE  `compte de récompence` SET  Points = Points+1 WHERE `Membre equipeID` = NEW.`Membre equipeID`;
		END IF;		
	END IF;
END;$$

