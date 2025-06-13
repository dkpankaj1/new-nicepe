<?php

// lang/en/messages.php

return [
    'success' => [
        'default' => 'Operation completed successfully.',
        'created' => ':item created successfully.',
        'updated' => ':item updated successfully.',
        'deleted' => ':item deleted successfully.',
        'retrieved' => ':item retrieved successfully.',
        'submitted' => 'Your submission was successful.',
    ],

    'error' => [
        'default' => 'An error occurred. Please try again.',
        'not_found' => ':item not found.',
        'validation' => 'There was a validation error.',
        'unauthorized' => 'You are not authorized to perform this action.',
        'server' => 'Server error. Please contact support.',
        'conflict' => 'There is a conflict with your request.',
    ],

    'crud' => [
        'create' => [
            'success' => ':item created successfully.',
            'error' => 'Failed to create :item.',
        ],
        'read' => [
            'success' => ':item retrieved successfully.',
            'error' => 'Failed to retrieve :item.',
        ],
        'update' => [
            'success' => ':item updated successfully.',
            'error' => 'Failed to update :item.',
        ],
        'delete' => [
            'success' => ':item deleted successfully.',
            'error' => 'Failed to delete :item.',
        ],
    ],

    'api' => [
        'success' => 'API request completed successfully.',
        'error' => 'API request failed.',
        'data_not_found' => 'Requested data not found.',
        'invalid_request' => 'Invalid API request.',
        'unauthenticated' => 'You must be logged in to access this resource.',
        'rate_limit' => 'Rate limit exceeded. Please try again later.',
    ],

    'auth' => [
        'login_success' => 'Logged in successfully.',
        'login_failed' => 'Invalid credentials.',
        'logout_success' => 'Logged out successfully.',
        'unauthorized' => 'Unauthorized access.',
        'register_success' => 'Registration completed successfully.',
        'register_failed' => 'Registration failed. Please try again.',
    ],

    'custom' => [
        'action_not_allowed' => 'This action is not allowed.',
        'something_went_wrong' => 'Something went wrong. Please try again later.',
        'operation_successful' => 'The operation was successful.',
    ],
];
