import React, { useState } from "react";
import { twJoin } from "tailwind-merge";
import { FieldGroup, Label } from "./ui";
import { IconFile } from "justd-icons";

type FilePickerProps = {
    label: string;
    name: string;
    isRequired?: boolean;
    onChange: (files: FileList | null) => void;
    ref: React.RefObject<HTMLInputElement>;
    prefix?: React.ReactNode;
    suffix?: React.ReactNode;
    accept?: string;
    multiple?: boolean;
    className?: string;
    value?: string;
};

export const FilePicker = ({
    label,
    name,
    isRequired,
    onChange,
    ref,
    accept,
    multiple,
    className,
    value,
}: FilePickerProps) => {
    return (
        <div className={twJoin("flex flex-col gap-y-1.5", className)}>
            <Label className="mb-1.5">
                {label} {isRequired && <span className="text-red-500 ml-1">*</span>}
            </Label>
            <FieldGroup
                className={twJoin(
                    "**:[button]:size-7 **:[button]:shrink-0 **:[button]:p-0",
                    "[&>[data-slot=suffix]>button]:mr-[calc(var(--spacing)*-1.15)] [&>[data-slot=suffix]>button]:rounded-md [&>[data-slot=suffix]>button]:data-focus-visible:outline-1 [&>[data-slot=suffix]>button]:data-focus-visible:outline-offset-1",
                    "[&>[data-slot=prefix]>button]:mr-[calc(var(--spacing)*-1.15)] [&>[data-slot=prefix]>button]:rounded-md [&>[data-slot=prefix]>button]:data-focus-visible:outline-1 [&>[data-slot=prefix]>button]:data-focus-visible:outline-offset-1"
                )}
            >
                <span data-slot="prefix" className="atrs x2e2">
                    <IconFile />
                </span>
                <input
                    type="file"
                    name={name}
                    className={twJoin(
                        "w-full min-w-0 [&::-ms-reveal]:hidden bg-transparent py-2 px-2.5 text-base text-fg placeholder-muted-fg outline-hidden data-focused:outline-hidden sm:text-sm"
                    )}
                    ref={ref}
                    accept={accept}
                    multiple={multiple}
                    onChange={(e) => {
                        const files = e.target.files;
                        onChange(files);
                    }}
                    required={isRequired}
                />
            </FieldGroup>
        </div>
    );
};
