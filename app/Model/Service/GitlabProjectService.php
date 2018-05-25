<?php

namespace App\Model\Service;


use Illuminate\Support\Collection;

class GitlabProjectService extends GitlabServiceAbstract
{

    protected function getListUrl(): string
    {
        return config('gitlab.urls.project-list');
    }

    protected function getItemUrl(): string
    {
        return config('gitlab.urls.project-item');
    }

    public function getList(array $urlParameters = [], array $requestParameters = []): Collection
    {
        $list = parent::getList($urlParameters, $requestParameters);

        foreach ($list as $key => $item) {
            $item['namespace_id'] = $item['namespace']['id'];
            $item['namespace_full_path'] = $item['namespace']['full_path'];
            $list->put($key, $item);
        }

        return $list;
    }
}