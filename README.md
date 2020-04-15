# SymfonyYAMLing

How does it work ?

### Requirements
- docker-compose
- docker
- make

### Step 1
- Enter the project

### Step 2
- Rename `docker-compose.override.yml.dist` into `docker-compose.override.yml`
- Go to `docker-compose.override.yml`
- Add a port you're not currently using : `- 'here:80'`

### Step 3
- Go back to the project folder

### Step 4
`$ make start`

### Step 5
- Go to your favourite browser and type: `http://localhost:xxxx`
- Replace `xxxx` with the port defined before

### Step 6
- Smile :D
