---
name: git-promote
description: Sync vivceramic project assets to the hallowceramics-theme-auto-pages theme folder, then automate the full Git promotion workflow — stage all changes, commit, push Chuck-Zhang branch, merge to main, push main. Use when the user says "sync" or indicates they want to synchronize theme files and push to production. Remote is "github", feature branch is "Chuck-Zhang", main branch is "main".
---

# Git Promote

Syncs the `hallowceramics-theme-auto-pages` theme folder with the latest project assets, then promotes current work from `Chuck-Zhang` to `main` and pushes both to the `github` remote.

## Workflow

Execute these steps **sequentially** — each depends on the previous:

### Step 1 — Sync theme assets

Copy changed project assets into the WordPress theme folder so both stay aligned:

```bash
# CSS (must always match)
copy viviceramic\css\styles.css viviceramic\hallowceramics-theme-auto-pages\assets\css\styles.css /Y

# PHP templates — check if each was modified and copy if so:
copy viviceramic\about.html viviceramic\hallowceramics-theme-auto-pages\ (if modified)
copy viviceramic\wordpress-import\fragment-about-inner.html viviceramic\wordpress-import\fragment-about-inner.html (if modified)
```

Use `git diff --name-only` before this step to detect which files changed, then sync only the ones that have a theme counterpart.

| Source file | Theme counterpart |
|-------------|-------------------|
| `viviceramic/css/styles.css` | `viviceramic/hallowceramics-theme-auto-pages/assets/css/styles.css` |
| `viviceramic/about.html` | (review for page-about.php alignment) |
| `viviceramic/wordpress-import/fragment-about-inner.html` | (review for WXR consistency) |

### Step 2 — Collect commit message

Ask the user for a commit message. If none provided, default to `feat: staged changes`.

### Step 3 — Ensure on Chuck-Zhang

```bash
git checkout Chuck-Zhang
```

If switching fails (uncommitted conflicts), abort and tell user to resolve first.

### Step 4 — Stage & commit

```bash
git add -A
git commit -m "<user message or default>"
```

### Step 5 — Push feature branch

```bash
git push github Chuck-Zhang
```

### Step 6 — Merge to main

```bash
git checkout main
git merge Chuck-Zhang --no-edit
```

If merge opens vim, use `git commit -m "Merge branch 'Chuck-Zhang'"` to finalize.

### Step 7 — Push main

```bash
git push github main
```

### Step 8 — Return to Chuck-Zhang

```bash
git checkout Chuck-Zhang
```

## Error handling

| Failure | Action |
|---------|--------|
| Branch switch fails | `git status` to check dirty state; tell user to resolve |
| Push rejected (non-fast-forward) | `git pull github Chuck-Zhang --rebase` then retry push |
| Merge conflict | Tell user which files conflict; do NOT auto-resolve |

## Key config

- Remote: `github` (not `origin`)
- Feature branch: `Chuck-Zhang`
- Main branch: `main`
