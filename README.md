Functionalities
1. User Management:
    - Create a user model with fields for username, email, and password
    - Implement user registration, login, and logout functionality
    - Use password hashing and salting for secure password storage
2. Blog Post Management:
    - Create a blog post model with fields for title, content, author, and timestamp
    - Implement CRUD (create, read, update, delete) operations for blog posts
    - Use pagination for retrieving blog posts
3. Comment Management:
    - Create a comment model with fields for content, author, and timestamp
    - Implement CRUD operations for comments
    - Use pagination for retrieving comments
4. API Endpoints:
    - Implement the following endpoints:
        - GET /users: Retrieve a list of users
        - GET /users/:id: Retrieve a single user by ID
        - POST /users: Create a new user
        - GET /blog-posts: Retrieve a list of blog posts
        - GET /blog-posts/:id: Retrieve a single blog post by ID
        - POST /blog-posts: Create a new blog post
        - GET /comments: Retrieve a list of comments
        - GET /comments/:id: Retrieve a single comment by ID
        - POST /comments: Create a new comment
5. Security:
    - Implement authentication and authorization using JSON Web Tokens (JWT)
    - Use middleware to validate and authenticate requests
