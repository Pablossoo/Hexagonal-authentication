<?php

$finder = PhpCsFixer\Finder::create()
    ->exclude('node_modules')
    ->exclude('vendor')
    ->in(__DIR__);
return PhpCsFixer\Config::create()
    ->setRiskyAllowed(true)
    ->setRules([
        '@PSR2' => true,
        '@PSR1' => true,
        'array_syntax' => [ 'syntax' => 'short' ],
        'binary_operator_spaces' => [ 'align_equals' => false, 'align_double_arrow' => false ],
        'cast_spaces' => true,
        'combine_consecutive_unsets' => true,
        'concat_space' => [ 'spacing' => 'one' ],
        'linebreak_after_opening_tag' => true,
        'no_blank_lines_after_class_opening' => true,
        'no_blank_lines_after_phpdoc' => true,
        'no_extra_consecutive_blank_lines' => true,
        'no_whitespace_in_blank_line' => true,
        'no_spaces_around_offset' => true,
        'no_unused_imports' => true,
        'no_useless_else' => true,
        'no_useless_return' => true,
        'no_whitespace_before_comma_in_array' => true,
        'normalize_index_brace' => true,
        'phpdoc_indent' => true,
        'phpdoc_to_comment' => true,
        'phpdoc_trim' => true,
        'single_quote' => true,
        'ternary_to_null_coalescing' => true,
        'trailing_comma_in_multiline_array' => true,
        'trim_array_spaces' => true,
        'method_argument_space' => ['ensure_fully_multiline' => false],
        'no_break_comment' => false,
        'blank_line_before_statement' => true,
        'declare_strict_types' => true,
        'ordered_class_elements' => ['order' => ['use_trait', 'public', 'protected', 'private', 'constant', 'constant_public', 'constant_protected', 'constant_private', 'property', 'property_static', 'property_public', 'property_protected', 'property_private', 'property_public_static', 'property_protected_static', 'property_private_static', 'construct', 'method', 'method_static', 'method_public', 'method_protected', 'method_private', 'method_public_static', 'method_protected_static', 'method_private_static', 'destruct', 'magic', 'phpunit']],
        'class_attributes_separation' => true,
        'phpdoc_line_span' => ['property' => 'single', 'method' => 'single', 'const' => 'single']
    ])
    ->setFinder($finder);
