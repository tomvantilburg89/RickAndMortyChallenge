# RickAndMortyChallenge

The bax-music Rick and Morty (backend) code challenge, add explanation here once the challenge arrives.

---

# Challenge development introduction

### [Usage guide](#usage-guide-1)

This section will explain in full detail how to run the project and how to use the project

### [Development flow log](#development-flow-log-1)

This section will keep track of the entire development process, how I engaged in the project and what steps I took in
order to give a full detailed insight in my development process.

in **project initialisation** are just the simple steps taking on initialising the project requirements for development
like: `GitHub`, `JIRA` etc. Just out of the need of being extremely verbose, I decided to incorporate these steps.

in **JIRA Project issues** are all my `kanban` tasks from my personal JIRA account. Because I am used working this way
for a couple of years, I keep this habit also for my personal projects because I like to be able to see what I did, what
I need to do and what my overal process was in all my development projects to date. Also it keeps me sharp and focussed
when working in development teams.
This section will keep track of the entire development process, how I engaged in the project and what steps I took in
order to give a full detailed insight in my development process.

### [Used resources](#used-resources-1)

In here you will be able to find all documentation links, repositories etcetera that I have used during this challenge.
This is more or less for myself, but also for the ones that need to review my challenge, as they can exactly see how I
engaged and what sources I've used to tackle this assignment.

### [Developer side notes](#developer-side-notes-1)

Just some notes about myself and how I see the future, this is just a bonus and a minor reflection of my enthusiasm
engaging this challenge and my prospect for the company I am applying to.

---

# Usage guide

### Installing and running the program

```bash
    git clone git@github.com:tomvantilburg89/RickAndMortyChallenge.git
```

```bash
    docker compose build --no-cache --pull && docker compose up -d
```

---

# Development flow log

### 1. Project Initialisation

1. Create git repository on new account
2. Install symfony CLI in local `WSL2` environment
    ```bash
    wget https://get.symfony.com/cli/installer -O - | bash
    ```
3. Setup JIRA Project for Bax Rick and Morty Challenge
    - JIRA issue key: `BAXRMC`

### 2. JIRA Project issues

<i>Note: tasks used in JIRA have been executed in the order displayed below</i>

- `BAXRMC-1` Create new symfony project
- `BAXRMC-2` Update `README.md` and `.gitignore`
- `BAXRMC-3` Setup Symfony docker skeleton
    - **@see [`Used resources`](#used-resources-1)**

    ```bash 
        git clone git@github.com:dunglas/symfony-docker.git
    ```

    ```bash 
        cd symfony-docker
    ```

    ```bash
        git archive --format=tar HEAD | tar -xC ../
    ```

    ```bash
        cd ../ && rm -rf symfony-docker
    ```

    ```bash
        composer config --json extra.symfony.docker 'true'
    ```

    ```bash
        rm symfony.lock
        composer recipes:install --force --verbose
    ```

- `BAXRMC-7` Create Rick and Morty API service for the Service container
- `BAXRMC-8` Create a controller to test API Service, test in postman
- `BAXRMC-9` Include Nick Been's RickAndMorty PHP Client and add it to the service
- `BAXRMC-10` Add CharacterService
- `BAXRMC-11` Add LocationService
- `BAXRMC-12` Add EpisodeService
- `BAXRMC-17` Install tailwind, webpack and make base layout
    - Install webpack encore
    - Install tailwind
    - Added PageController and view
    - Create base layout using TailwindCSS
    - added stacked layout to base and split navigation to parts/navigation.html.twig
    - Changed indigo to pink to match bax music color theme slightly
    - Added AlpineJS in order to prepare to use AlpineJS in a later stage
    - Removed and commented out unnecessary tailwindui defaults
- `BAXRMC-25` Create new API Client for Rick and Morty API
    - Removed Nick Been's PHP Client, it did not suit the scope of the challenge
    - Update Location Service
- `BAXRMC-13` Show all characters that exist (or are last seen) in a given dimension
    - Finalized ApiClient and added functionality to retrieve location by name and page
    - Made sure we have pagination feature for retrieving the list of locactions
    - Added hasError() functionality
- `BAXRMC-14` Show all characters that exist (or are last seen) in a given dimension
    - Updated readme.md developer flow log at `BAXRMC-13`
    - Added functionality to retrieve by Dimension in the LocationService
    - Create Dimension Controller, use LocationController as reference.
    - Show all characters in a given dimension
- `BAXRMC-15` Show all characters that partake in a given episode
    - Create Episode Service to accommodate episodes
    - Added character controller in order to prepare for later views
    - Updated episodes template files and controller
    - Refactored residents and character map to incorporate hook
    - commit Added character loop to character.show template
- `BAXRMC-30` Update navigation template to accomodate Locations, Episodes and Characters
    - added navigation items and updated homepagecontroller with lipsum generated text
- `BAXRMC-32` Make twig template for pagination on all views
    - Create pagination view and add it to the CharacterController index template
    - Added pagination template and added to characters index
    - Added pagination to episodes index and altered pagination template
    - Added pagination to locations index
- `BAXRMC-26` Update all index templates to make it all pretty and add links
    - Update characters index template
    - Add character avatar to character index template
    - Update character index and add character template part
    - Changed location controller show method to make more sense
    - Changed dimension controller to be altered for search
    - updated location index template accordingly
    - Updated episodes index template accordingly
- `BAXRMC-34` Add dimension search field to navigate to a "given" dimension
    - Updated dimension search to incorporate CSRF_TOKEN protection
- `BAXRMC-16` Showing all information of a character (Name, species, gender, last location, dimension, etc)
    - Fixed Character and Episode controller show methods
    - Added characters list to dimension search view
    - Updated location show template to show all information and residents
    - Update episode show template to show all information
    - Update character show template to show all information

---

# Used resources

Here are the resources used to develop this code challenge application for the `Bax Music Rick and Morty Code Challenge`

- [Install Symfony CLI](https://symfony.com/download)
- [Installing & Setting up the Symfony Framework](https://symfony.com/doc/current/setup.html)
- [Add Docker skeleton to existing symfony project](https://github.com/dunglas/symfony-docker/blob/main/docs/existing-project.md)
- [Symfony Service Container](https://symfony.com/doc/current/service_container.html)
- [Symfony HTTP Client](https://symfony.com/doc/current/http_client.html)
- [The Rick and Morty API](https://rickandmortyapi.com/)
- [Libraries | PHP Client](https://rickandmortyapi.com/documentation/#php)
- [Nick Been - Rick and Morty API Library PHP Client](https://github.com/nickbeen/rick-and-morty-api-php)
- [Setting up Tailwind CSS in a Symfony project](https://tailwindcss.com/docs/guides/symfony)
- [Front-end Tools: Handling CSS & Javascript](https://symfony.com/doc/current/frontend.html)
- [Encore: setting up your project](https://symfony.com/doc/current/frontend/encore/simple-example.html)
- [Install Tailwind CSS with Symfony](https://tailwindcss.com/docs/guides/symfony)
- [TailwindUI](https://tailwindui.com)
    - Using my own login to make use of tailwindUI components, knew it would come in handy someday
- [Tailwind using html and your own JS](https://tailwindui.com/documentation#using-html-and-your-own-js)
- [Alpine.JS](https://alpinejs.dev/)
- [Symfony - Controller](https://symfony.com/doc/current/controller.html)
- [Symfony - Session](https://symfony.com/doc/current/session.html)
- [Symfony - Linking to pages](https://symfony.com/doc/current/templates.html#templates-link-to-pages)

---

# Used tools

- WSL2 (Windows Subsystem for Linux)
    - Because I am a power user, but can't get around using linux <3
- Postman, to test API endpoints
- IntelliJ PHPStorm, to develop the application
- Git, to make use of version control
- Bash, to make terminal commands
- Docker, because containerization is king

---

# Developer side notes

**9/05/2024** - pre-assignment challenge notes

Currently (at point of writing this README.md) I have not yet received the challenge, however I found an old repository
from a different developer, that I am currently using as a reference as it's kind of already clear what the assignment
will be.

However at this time, I am not making false assumptions and are merely developing from that specific repository point of
view and will finalize/alter this repository according to the challenge when time arrives.

---

Recently I had a job interview at Bax-Music and they required me to do a coding challenge incorporating the Rick and
Morty API.

I have decided to start my development career from scratch and open up a new GitHub account to accommodate the new
career path. In this new GitHub account I will keep updating my path in the future as I will attend college in September
and due to this knowledge I have decided it's time to move to a new account, because it's definitely going to mark a new
chapter in my life and ambitions. My old repositories will remain online, more for personal references but the account
corresponding to the repositories will be abandoned.

- Gists
- Personal projects
- Academic assigments

The company is the best of both worlds to me, because I am already a musician and amateur music producer and my other
passion is Software- and webdevelopment. I am very enthusiastic to start this new chapter because of this knowledge.
