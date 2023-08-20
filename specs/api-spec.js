const API_SPEC = [
    {
        object: "Authentication",
        specs: [
            {
                name: "Sign In",
                method: "POST",
                uri: "/auth/login",
                description: "",
                expected_response: null,
            },
            {
                name: "Sign Out",
                method: "POST",
                uri: "/auth/logout",
                description: "",
                expected_response: null,
            },
            {
                name: "Register",
                method: "POST",
                uri: "/auth/register",
                description: "",
                expected_response: null,
            },
            {
                name: "My Profile",
                method: "GET",
                uri: "/auth/me",
                description: "",
                expected_response: null,
            },
        ],
    },
    {
        object: "Post",
        specs: [
            {
                name: "Get Posts",
                method: "GET",
                uri: "/posts",
                description: "",
                expected_response: null,
            },
            {
                name: "Get Post",
                method: "GET",
                uri: "/posts/:post_id",
                description: "",
                expected_response: null,
            },
            {
                name: "Create Post",
                method: "POST",
                uri: "/posts",
                description: "",
                expected_response: null,
            },
            {
                name: "Update Post",
                method: "PATCH",
                uri: "/posts/:post_id",
                description: "",
                expected_response: null,
            },
            {
                name: "Delete Post",
                method: "DELETE",
                uri: "/posts/:post_id",
                description: "",
                expected_response: null,
            },
            {
                name: "Get By Post",
                method: "GET",
                uri: "/posts/:post_id/comments",
                description: "",
                expected_response: null,
            },
            {
                name: "Get By Post Detail",
                method: "GET",
                uri: "/posts/:post_id/comments/:comment_id",
                description: "",
                expected_response: null,
            },
            {
                name: "Create Post Comment",
                method: "POST",
                uri: "/posts/:post_id/comments",
                description: "",
                expected_response: null,
            },
            {
                name: "Update Post Comment",
                method: "PATCH",
                uri: "/posts/:post_id/comments/:comment_id",
                description: "",
                expected_response: null,
            },
            {
                name: "Delete Post Comment",
                method: "DELETE",
                uri: "/posts/:post_id/comments/:comment_id",
                description: "",
                expected_response: null,
            },
        ],
    },
    {
        object: "Category",
        specs: [
            {
                name: "Get Categories",
                method: "GET",
                uri: "/categories",
                description: "",
                expected_response: null,
            },
            {
                name: "Get Single Categories",
                method: "GET",
                uri: "/categories/:category_id",
                description: "",
                expected_response: null,
            },
            {
                name: "Create Categories",
                method: "POST",
                uri: "/categories",
                description: "",
                expected_response: null,
            },
            {
                name: "Update Categories",
                method: "PATCH",
                uri: "/categories/:category_id",
                description: "",
                expected_response: null,
            },
            {
                name: "Delete Categories",
                method: "DELETE",
                uri: "/categories/:category_id",
                description: "",
                expected_response: null,
            },
        ],
    },
    {
        object: "User",
        specs: [
            {
                name: "Get Profile",
                method: "GET",
                uri: "/users/:user_id",
                description: "",
                expected_response: null,
            },
            {
                name: "Update Profile",
                method: "PATCH",
                uri: "/users/:user_id",
                description: "",
                expected_response: null,
            },
            {
                name: "Delete Account Profile",
                method: "DELETE",
                uri: "/users/:user_id",
                description: "",
                expected_response: null,
            },
        ],
    },
];
