$question = @"

VIDEX: You want ONLY the latest login device to be able to do transactions.
Which sessions should be invalidated on new login?
1) Web (browser) sessions only (Laravel session/cookie login)
2) API tokens only (Sanctum/personal access tokens)
3) Both web sessions + API tokens (recommended if you use both)
4) Other (describe)
"@

Write-Host $question -NoNewline
$answer = Read-Host "Enter 1/2/3/4"
Write-Host "You selected: $answer"
