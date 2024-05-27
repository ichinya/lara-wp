<?php

namespace Ichinya\LaraWP\Enums;

enum PostStatuses: string
{
    case Draft = 'draft';
    case AutoDraft = 'auto-draft';
    case Publish = 'publish';
    case Inherit = 'inherit';
}
