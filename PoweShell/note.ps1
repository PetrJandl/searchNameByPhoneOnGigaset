#  Install-Module -Name BurntToast

function showNote {
    $Header = New-BTHeader -Title 'Volá čtenář'
    $Button = New-BTButton -Content 'OK' -Dismiss
    New-BurntToastNotification -Text "Vomáčka František","007654"  -Header $Header -Button $Button
}                     

$var = 1
while ($var -le 100)
{

$var++

Start-Sleep -Milliseconds 50

    if($var -eq 99){
        $var=1
        showNote
    }
}




#echo "Vomacka Franta" | clip


