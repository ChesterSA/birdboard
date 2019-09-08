<?php
namespace App;

trait RecordsActivity
{
  public $oldAttributes = [];

  public static function bootRecordsActivity()
  {
    foreach(self::recordableEvents() as $event){

      static::$event(function($model) use ($event){
        $model->recordActivity($model->activityDescription($event));
      });

      if ($event === 'updated'){
        static::updating(function ($model) {
          $model->oldAttributes = $model->getOriginal();
        });
      }

    }
  }

  public function recordActivity($description)
  {
    $this->activity()->create([
      'project_id' => class_basename($this) === 'Project' ? $this->id : $this->project_id,
      'description' => $description,
      'changes' =>  $this->activityChanges()
    ]);
  }

  protected function activityChanges()
  {
    if ($this->wasChanged())
    {
      return [
        'before' => array_diff($this->oldAttributes, $this->getAttributes()),
        'after' => $this->getChanges()
      ];
    }
  }

  protected function activityDescription($description)
  {
      // return $description;
      // return strtolower(class_basename($this));
      return  "{$description}_" . strtolower(class_basename($this)); //created_task
  }

  public function activity()
  {
    return $this->morphMany(Activity::class, 'subject')->latest();
  }

  protected static function recordableEvents()
  {
    if (isset(static::$recordableEvents)){
      return static::$recordableEvents;
    }
    else {
      return ['created', 'updated', 'deleted'];
    }
  }
}
