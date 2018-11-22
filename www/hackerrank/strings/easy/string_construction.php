<?php

// Complete the twoStrings function below.
function stringConstruction($s) {
    return (sizeOf(array_unique(str_split($s))));
}


echo '<pre>';
print_r([
    'gbcebabbfffcdgfeeaadecaeecabbabbgcafeabgecfeffcbafgdegdacefcadabbfdcgcebegbfgeeebfegfacdagbbgeagaaceefcaedceacceebdgebeecedcbdbeebecgcfcgdaaaegfbcbfffccffabbceafaagdedadbfcaedaffbagg' => stringConstruction('gbcebabbfffcdgfeeaadecaeecabbabbgcafeabgecfeffcbafgdegdacefcadabbfdcgcebegbfgeeebfegfacdagbbgeagaaceefcaedceacceebdgebeecedcbdbeebecgcfcgdaaaegfbcbfffccffabbceafaagdedadbfcaedaffbagg'),    // Expected 7
    'abcd' => stringConstruction('abcd'),    // Expected 4
    'abab'    => stringConstruction('abab'),       // Expected 2
]);
echo '</pre>';