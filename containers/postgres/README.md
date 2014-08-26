Postgres
========

### Overview

This Docker container provides a basic Postgres service for DrupalCI.

### Usage

#### Docker links

This host is linked to other containers and is generally accessible with the
following details:

```
Host: postgres
User: postgres
Pass: postgres
```

_The details are so simple because we kill this service after each build._
