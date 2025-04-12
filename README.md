# Sommaire
- [Sommaire](#sommaire)
- [Le projet](#le-projet)
  - [Technologies](#technologies)
  - [Base de données](#base-de-données)
  - [Vidéos](#vidéos)
  - [Maquettes](#maquettes)
    - [Page d'accueil](#page-daccueil)
      - [Mobile](#mobile)
      - [Desktop](#desktop)
    - [Page d'un article](#page-dun-article)
      - [Mobile](#mobile-1)
      - [Desktop](#desktop-1)

# Le projet

Open**Blog** est un **blog multi auteurs** créé avec **Symfony 7** dans une série de tutoriels présents sur la chaîne **Nouvelle-Techno.fr** à cette adresse : https://www.youtube.com/playlist?list=PLBq3aRiVuwywmwPHz0BzPFvH0P-37mH8K

## Technologies

Open**Blog** sera développé en utilisant :

- Docker
- Symfony 7
- Mysql 8.0
- PHP 8.2
- PHPMyAdmin
- Sass

L'utilisation de bundles sera limitée au strict nécessaire.

## Base de données
Vous trouverez le **schéma de base de données** ici : https://drawsql.app/teams/ma-team-7/diagrams/blog-symfony-7

![Database](assets/images/project/Database.png)

## Vidéos

1. [Présentation et configuration du projet](https://www.youtube.com/watch?v=isyfqqizOGI&list=PLBq3aRiVuwywmwPHz0BzPFvH0P-37mH8K) ([Commit Github](https://github.com/NouvelleTechno/OpenBlog/tree/b27fccc6600867f5371a272a7b708037bd725e52))
2. [Introduction sur les contrôleurs](https://www.youtube.com/watch?v=WRg6msiB87g&list=PLBq3aRiVuwywmwPHz0BzPFvH0P-37mH8K) ([Commit Github](https://github.com/NouvelleTechno/OpenBlog/tree/3f1f388484a3e437af17601ee8084ed5149821a8))
3. [Les templates et Assets](https://www.youtube.com/watch?v=TfESYhlcIrU&list=PLBq3aRiVuwywmwPHz0BzPFvH0P-37mH8K) ([Commit Github](https://github.com/NouvelleTechno/OpenBlog/tree/f0f6fc7aabded4f223148ad2d3333fa6ac700041))
4. [Création de la base de données](https://www.youtube.com/watch?v=SM1TZuvAs-M&list=PLBq3aRiVuwywmwPHz0BzPFvH0P-37mH8K) ([Commit Github](https://github.com/NouvelleTechno/OpenBlog/tree/f35223baf26b3a06d8d1ca87557d810fd3bf2c39))
5. [Inscription et Authentification des utilisateurs](https://www.youtube.com/watch?v=zXCeT2dGUOY&list=PLBq3aRiVuwywmwPHz0BzPFvH0P-37mH8K) ([Commit Github](https://github.com/NouvelleTechno/OpenBlog/tree/61072795e6b6030de97fc495b4bb73bdbfb05234))
6. [Envoi du mail de confirmation du compte des utilisateurs](https://www.youtube.com/watch?v=p3Fr6ekX3Fo&list=PLBq3aRiVuwywmwPHz0BzPFvH0P-37mH8K) ([Commit Github](https://github.com/NouvelleTechno/OpenBlog/tree/b6e4588c46824c2dce2ce23fd8d5940bdc529a8f))
7. [Réinitialisation du mot de passe des utilisateurs](https://www.youtube.com/watch?v=JbAgml9lqtk&list=PLBq3aRiVuwywmwPHz0BzPFvH0P-37mH8K) ([Commit Github](https://github.com/NouvelleTechno/OpenBlog/tree/bf45f72a699ac83ba7c145dbd051b5d9120b188c))
8. [Création des formulaires](https://www.youtube.com/watch?v=wIt2MIeHZSs&list=PLBq3aRiVuwywmwPHz0BzPFvH0P-37mH8K) ([Commit Github](https://github.com/NouvelleTechno/OpenBlog/tree/443bdf123b49c4ac1866e04c95d6e793a95210b1))
9. [Les Datafixtures](https://www.youtube.com/watch?v=SY3ivIptFiE&list=PLBq3aRiVuwywmwPHz0BzPFvH0P-37mH8K) ([Commit Github](https://github.com/NouvelleTechno/OpenBlog/tree/d18c441b1640736929a480a86a72a5a80c48d733))
10. [Validation des formulaires](https://www.youtube.com/watch?v=AYdpze6wS4Y&list=PLBq3aRiVuwywmwPHz0BzPFvH0P-37mH8K) ([Commit Github](https://github.com/NouvelleTechno/OpenBlog/tree/519783b603af4652250915676d5ce4e31bbd55e2))
11. [Validation frontend - Entropie de mots de passe](https://www.youtube.com/watch?v=YSugfoEsKck&list=PLBq3aRiVuwywmwPHz0BzPFvH0P-37mH8K) ([Commit Github](https://github.com/NouvelleTechno/OpenBlog/tree/6be214fa7fad1dd49db3cf4229efca42e5b56768))
12. [Upload d'Images et Redimensionnement](https://www.youtube.com/watch?v=86V9rAQ6w9k&list=PLBq3aRiVuwywmwPHz0BzPFvH0P-37mH8K) ([Commit Github](https://github.com/NouvelleTechno/OpenBlog/tree/7d26a35cc9565f057754e4297f8f2140c2925322))
13. [Accès aux données relationnelles](https://www.youtube.com/watch?v=R26QYHx_HkI&list=PLBq3aRiVuwywmwPHz0BzPFvH0P-37mH8K) ([Commit Github](https://github.com/NouvelleTechno/OpenBlog/tree/0673f5bd7890742480258ee8ddb3dc2b41e9eed4))
14. [Du CSS et Sass avec la création de la barre de navigation](https://www.youtube.com/watch?v=Oc2Tq2BF8Xw&list=PLBq3aRiVuwywmwPHz0BzPFvH0P-37mH8K) ([Commit Github](https://github.com/NouvelleTechno/OpenBlog/tree/ff57c7c6a928e71220c9d148f7fe08ed3b3ecac3))
15. [Du CSS et Sass avec la création de la page d'accueil](https://www.youtube.com/watch?v=nWuop5C3kbQ&list=PLBq3aRiVuwywmwPHz0BzPFvH0P-37mH8K) ([Commit Github](https://github.com/NouvelleTechno/OpenBlog/tree/37390971bfa77c79982219f812c804090dfe2615))
16. [Utiliser CKEditor 5 pour écrire les articles](https://www.youtube.com/watch?v=Qwubyuogcz0&list=PLBq3aRiVuwywmwPHz0BzPFvH0P-37mH8K) ([Commit Github](https://github.com/NouvelleTechno/OpenBlog/tree/eada883f097a1ffde37f19db35a4dd3b918bc32e))
17. [Upload d'images dans CKEditor 5 avec SimpleUpload](https://www.youtube.com/watch?v=jUUGsCBwIJk&list=PLBq3aRiVuwywmwPHz0BzPFvH0P-37mH8K) ([Commit Github](https://github.com/NouvelleTechno/OpenBlog/tree/a084ac16c30560ed001f620b8b393d735fc5c9c3))
18. [Afficher le contenu des articles](https://www.youtube.com/watch?v=w2u-I1uD5Go&list=PLBq3aRiVuwywmwPHz0BzPFvH0P-37mH8K) ([Commit Github](https://github.com/NouvelleTechno/OpenBlog/tree/ad70123764830779fc80013b132890ff0537c1e6))
19. [Liste des articles avec pagination](https://www.youtube.com/watch?v=Q7oJcTTc6xw&list=PLBq3aRiVuwywmwPHz0BzPFvH0P-37mH8K) ([Commit Github](https://github.com/NouvelleTechno/OpenBlog/tree/64dd22c768585d5effec3e868a585f1854a9b9cf))
20. [Gérer les Permissions et les Accès](https://www.youtube.com/watch?v=-IfkdgssfFk&list=PLBq3aRiVuwywmwPHz0BzPFvH0P-37mH8K) ([Commit Github](https://github.com/NouvelleTechno/OpenBlog/tree/e8e198f223b231209d0eebbdefcef86bc29eddca))
21. [Gérer les Permissions et les Accès](https://www.youtube.com/watch?v=ri6TTMIB-f4&list=PLBq3aRiVuwywmwPHz0BzPFvH0P-37mH8K) ([Commit Github](https://github.com/NouvelleTechno/OpenBlog/tree/9c9ac44c0fef9bb94554972ea8696601e2b91f86))
2A venir

## Maquettes

Les maquettes sont disponibles sur [Figma](https://www.figma.com/file/WBF5w0A2qQ6qCfcMPP4Per/OpenBlog?type=design&node-id=0%3A1&mode=design&t=Fm5lnbz8ojK7uSlb-1)

### Page d'accueil

#### Mobile

![Page d'accueil Mobile](assets/images/project/HomePageMobile.png)

#### Desktop

![Page d'accueil Desktop](assets/images/project/HomePage.png)

### Page d'un article

#### Mobile

![Page d'un article Mobile](assets/images/project/SinglepostMobile.png)

#### Desktop

![Page d'un article Desktop](assets/images/project/Singlepost.png)