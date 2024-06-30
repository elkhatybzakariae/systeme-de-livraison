-- Make the 'ville' column nullable
ALTER TABLE client MODIFY COLUMN ville VARCHAR(255) NULL;

-- Add the foreign key constraint
ALTER TABLE client 
ADD CONSTRAINT fk_ville
FOREIGN KEY (ville) REFERENCES villes(id_V);
