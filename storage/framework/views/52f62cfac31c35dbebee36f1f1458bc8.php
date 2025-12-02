<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['name' => 'home', 'class' => 'w-5 h-5']));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['name' => 'home', 'class' => 'w-5 h-5']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php if($name === 'home'): ?>
<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" <?php echo e($attributes->merge(['class' => $class])); ?>>
  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l9-9 9 9M4 10v10h16V10" />
</svg>

<?php elseif($name === 'users'): ?>
<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" <?php echo e($attributes->merge(['class' => $class])); ?>>
  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-3-3.87M9 20H4v-2a4 4 0 013-3.87m3-4.13a4 4 0 100-8 4 4 0 000 8zM21 12a4 4 0 10-8 0 4 4 0 008 0z" />
</svg>

<?php elseif($name === 'graduation-cap'): ?>
<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" <?php echo e($attributes->merge(['class' => $class])); ?>>
  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0v6m-4-2h8" />
</svg>

<?php elseif($name === 'file-text'): ?>
<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" <?php echo e($attributes->merge(['class' => $class])); ?>>
  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6M8 8h8m-4-4h8a2 2 0 012 2v16a2 2 0 01-2 2H8a2 2 0 01-2-2V6a2 2 0 012-2z" />
</svg>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\lms_project\resources\views/components/icon.blade.php ENDPATH**/ ?>