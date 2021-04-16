# issue_40832

Setup:
1) Add DATABASE_URL TO .env or .env.local
2) Make database migration
 
Steps to reproduce:
1) Set mode to production in .env or .env.local
2) Open project in browser
3) Add value to title field
4) Submit => OK
5) Submit again (different value) => FAIL (This value is already used)
6) Clear cache (php bin/console cache:clear)
7) Submit again => OK
8) Submit again => FAIL
9) Set to dev mode
10) Submit => OK
11) Submit again => OK 
