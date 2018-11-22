UPDATE 
    p 
JOIN
    (SELECT 0 as nothing) nothing
ON 
    p.a = 11
SET 
    p.b = p.b+1 ;