<?php $pager->setSurroundCount(2) ?>

<nav class="flex justify-center items-center space-x-2" aria-label="Pagination">
    <?php if ($pager->hasPrevious()) : ?>
        <a href="<?= $pager->getFirst() ?>" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-100">
            <?= lang('Pager.first') ?>
        </a>
        <a href="<?= $pager->getPreviousPage() ?>" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-100">
            <?= lang('Pager.previous') ?>
        </a>
    <?php endif ?>

    <?php foreach ($pager->links() as $link) : ?>
        <a href="<?= $link['uri'] ?>" class="px-4 py-2 text-sm font-medium border rounded-md <?= $link['active'] ? 'bg-blue-600 text-white border-blue-600' : 'text-gray-700 bg-white border-gray-300 hover:bg-gray-100' ?>">
            <?= $link['title'] ?>
        </a>
    <?php endforeach ?>

    <?php if ($pager->hasNext()) : ?>
        <a href="<?= $pager->getNextPage() ?>" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-100">
            <?= lang('Pager.next') ?>
        </a>
        <a href="<?= $pager->getLast() ?>" class="px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md hover:bg-gray-100">
            <?= lang('Pager.last') ?>
        </a>
    <?php endif ?>
</nav>