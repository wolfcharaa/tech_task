<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\Container0yNp38S\App_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/Container0yNp38S/App_KernelDevDebugContainer.php') {
    touch(__DIR__.'/Container0yNp38S.legacy');

    return;
}

if (!\class_exists(App_KernelDevDebugContainer::class, false)) {
    \class_alias(\Container0yNp38S\App_KernelDevDebugContainer::class, App_KernelDevDebugContainer::class, false);
}

return new \Container0yNp38S\App_KernelDevDebugContainer([
    'container.build_hash' => '0yNp38S',
    'container.build_id' => '29052835',
    'container.build_time' => 1707396679,
], __DIR__.\DIRECTORY_SEPARATOR.'Container0yNp38S');