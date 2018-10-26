UPDATE 
    p 
JOIN
    (SELECT 0 as nothing) nothing
ON 
    p.a = 11
SET 
    t.b = t.b+1 ;