DROP TRIGGER IF EXISTS raise_salery;
CREATE TRIGGER raise_salery BEFORE UPDATE ON `tache critique`
FOR EACH ROW 
	declare
		cursor c1 SELECT `ID` FROM `tache critique` WHERE `ProjetID` = NEW.`ProjetID`;
		cursor c2 SELECT `ID` FROM `tache critique`;
		cursor c3 SELECT `Membre equipeID` FROM `membre equipe` , `compte de récompence` WHERE  `ProjetID` = NEW.`ProjetID` AND `membre equipe`.`ID` = `compte de récompence`.`Membre equipeID` ORDER BY `Points` DESC;
		ID_c1 `tache critique`.`ID`%type;
		ID_c2 `tache critique`.`ID`%type;
		ID_c3 `membre equipe`.`Membre equipeID`%type;
		nb_c1 number := 0;
		nb_c2 number := 0;
		nb_c3 number := 0;
	begin
		open c2;
			loop
				fetch c2 into ID_c2;
				exit when c2%NOTFOUND;
				nb_c2 := nb_c2 + 1;
			end loop;
		close c2;
		open c1;
			loop
				fetch c1 into ID_c1;
				exit when c1%NOTFOUND;
				nb_c1 := nb_c1 + 1;
			end loop;
		close c1;
		IF (nb_c1 = nb_c2) THEN
			open c3;
				loop
					fetch c3 into ID_c3;
					exit when c3%NOTFOUND;
					nb_c3 := nb_c3 + 1;
					IF (nb_c3 < 3) THEN
						UPDATE  `compte de récompence` SET  salaire = salaire*1.1 WHERE `Membre equipeID` = ID_c3;
					ELSE
						UPDATE  `compte de récompence` SET  salaire = salaire*1.05 WHERE `Membre equipeID` = ID_c3;
					END IF;
				end loop;
			close c3;
		END IF;	
	end;
END;$$
----------------------------------------------------------------------------------------------------------------------------------------------------------
DROP TRIGGER IF EXISTS raise_points_tache_critique;
CREATE TRIGGER raise_points_tache_critique BEFORE UPDATE ON `tache critique`
FOR EACH ROW 
BEGIN 
	IF (NEW.`Date_fin` <= NEW.`Date_critique`) THEN
		UPDATE  `compte de récompence` SET  Points = Points+1 WHERE `Membre equipeID` = NEW.`Membre equipeID`;
	END IF;
	IF (NEW.`Date_fin` > NEW.`Date_critique`) THEN
		UPDATE  `compte de récompence` SET  Points = Points-3 WHERE `Membre equipeID` = NEW.`Membre equipeID`;
	END IF;
		
END;$$
----------------------------------------------------------------------------------------------------------------------------------------------------------
DROP TRIGGER IF EXISTS raise_points_tache_nn_critique;
CREATE TRIGGER raise_points_tache_nn_critique BEFORE UPDATE ON `tache non critique`
FOR EACH ROW 
BEGIN 
	IF (NEW.`Date_fin` <= NEW.`Date_plustot`) THEN
		UPDATE  `compte de récompence` SET  Points = Points+2 WHERE `Membre equipeID` = NEW.`Membre equipeID`;
	END IF;
	IF ((NEW.`Date_fin` > NEW.`Date_plustot`) AND (NEW.`Date_fin` <= NEW.`Date_plustard`)) THEN
		UPDATE  `compte de récompence` SET  Points = Points+1 WHERE `Membre equipeID` = NEW.`Membre equipeID`;
	END IF;
	IF (NEW.`Date_fin` > NEW.`Date_plustard`) THEN
		UPDATE  `compte de récompence` SET  Points = Points-1 WHERE `Membre equipeID` = NEW.`Membre equipeID`;
	END IF;		
END;$$

