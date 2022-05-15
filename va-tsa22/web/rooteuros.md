# RooteurOS (200)
#### web - [Virginia TSA Technosphere 2022 CTF](../main.md)

## Challenge description:
> Rooteur Inc. is a newcomer in the teleco industry. In their rush to market they appear to have skipped some parts of the QA process... including penetration testing.
>
> [https://vatsa-rooteuros.chals.io/](https://vatsa-rooteuros.chals.io/)

## Solution
Line 54 of the page source has an interesting comment:
```html
        <!-- Disable admin access until SQLi is fixed -->
        <button class="btn btn-primary btn-block" type="submit" disabled>Log In</button>
        <small class="text-muted text-center">Due to security issues, admin panel access is currently disabled</small>
```
SQLi stands for SQL injection, and we can remove the disabled attribute from the tag.

We can use this payload in one of the fields and "log in": `' OR 1=1 --//`

The quote closes out the string in the SQL query and allows us to pass it in as `True` regardless, likely as the SQL query is not prepared.

This successfully logs us in, with the flag on the "Export" page.

<details> 
    <summary>Flag</summary>
flag{r00teur-1nj3ct10n}
</details>